### Dynamic glow Framebuffer Attachment [#28](https://github.com/users/JKSunny/projects/1?pane=issue&itemId=70329729&issue=JKSunny%7CEternalJK%7C28)
	tags[master]

**Additions**
- [x] Dedicated dglow framebuffer attachment (2 when MSAA is enabled)
- [x] Z-Prepass

_**Current state**_
- Render surfaces in main renderpass, count glow surfaces in the scene per-view, 
- if any;
	- Begin dedicated renderpass and **_re-render_** surfaces using ```RB_RenderDrawSurfList()``` to extract glow-only surfaces [here](https://github.com/JKSunny/EternalJK/blob/b7d306868ce7052c4bd5102a45ef0dd8441e374c/codemp/rd-vulkan/tr_backend.cpp#L938C1-L950C3)
	- Perform blur renderpass to the extracted dglow attachment.
	- Begin post-dglow renderpass and blend blurred dglow textures. 
	- Draw the next view or when last draw 2D

> ⚠️ NOTE: In case of multi-view scene, this process repeats for each.
As you can imagine, it will perform blurring operations multiple times, and in case of many glowing surfaces (map t2_rogue)
will re-issue alot of drawcalls.

**_The idea_**
- Always have the dglow extract attachment in the main renderpass.
- Mark drawcalls with stages that have glow bundles in the fragment shader using ```Specialization Constants```
- Write color when glow texture else vec4( 0.0, 0.0, 0.0, 1.0 ) when drawcall has no glow (prevents sorting issues)
- When 2D drawing begins, blur and post-blend.

**_This will_**
- Work across multi-view scenes when the attachment is not cleared.
- Not create separate renderpasses
- Perform only one blur renderpass
- Blend the extracted glow attachment only once. 

####  Prototyping result:
- ❌ Having a 2nd attachment bound and write vec4( 0.0, 0.0, 0.0, 1.0 ) add fragment write overhead especially on scenes with little to no dglow surfaces causing FPS drops on most scenes.
- ❌ Added a Z-Prepass, reducing overdraw and omitting fragment writes at the cost of issuing drawcalls twice. (depth-only pass is faster, but still dropping FPS when scene doesnt have dglow)

#### Conclusion: Not worth it IMO for master branch. perhaps for PBR branches the reduced fragment overhead is more noticable. (Z-Prepass is nice to have feature there)

---

### Bindless Textures & Vertex buffers [#30](https://github.com/users/JKSunny/projects/1?pane=issue&itemId=112203279&issue=JKSunny%7CEternalJK%7C30)
	tags[pbr]

**Additions**
- [x] Introduced multi-threaded SPIR-V compiler, converting .bat to .cpp
- [x] One descriptor bound at frame start (textures array & SSBO)
- [x] No vertex/index/push bindings for Ghoul2 & MD3
- [x] Batch Ghoul2 and MD3 per-pipeline

On the quest to reducing frametimes, its important to identify bottlenecks. \
Determine if the limiting factor is on the CPU or GPU.

_**Current state**_
- CPU: Iterates over scene surfaces, perform culling, sorting and merging of vertex/index data on surfaces sharing a sort, textures/lightmap(atlassed now), pipeline, etc.
- CPU: Merge Ghoul2 or MD3 on sequenced indexes and share material, use indirect batching. 

> ⚠️ NOTE: This method performs well, but can issue alot tiny of drawcalls depending on the map setup. 
Ghoul2 introduces alot of drawcalls, because it does not merge surfaces from entities sharing same model setup.

**_The Idea_**
- Bindless textures using large array. (one descriptor binding at frame start, and not per drawcall)
- Pre filled SSBO at frame start containing all drawcall information, like matrices and material data.
- use VBO & IBO array for Ghoul2 and MD3 (omits vertex and index buffer command issueing )
- Create a temporary indirect command buffer, sorted by pipeline and issueing larger indirect calls. (only with texture and vbo array, because it is not dependening on bound descriptors/buffers )


	#### 🧪 Build options tr_local.h and glsl/global.h

	```#define VK_BINDLESS (core bindless logic with only texture array)```
	```#define VK_BINDLESS_VBO_ARRAY (omit vertex and index binding)```
	```#define VK_BINDLESS_BATCHED_INDIRECT (batch indirect calls per pipeline and omit vertex and index binding)```

	> cvar: r_bindless 0: off 1:on

	#### Following requires either one or none:
	
	```#define VK_BINDLESS_VBO_ARRAY```
	- This uses vbo[] ibo[] buffer array in the gpu. (Ghoul2 & MD3 only)
	- No need to issue bind vertex & index buffer commands
	- Drawcall logic remains the same

	```#define VK_BINDLESS_BATCHED_INDIRECT```
	- Same as above,
	- batches surface drawcalls to a per-pipeline indirect commands.
	- I had hoped more reduced overhead for bindless-vbo-batched-indirect. basicly drawing (currently only Ghoul2) in batches grouped by pipeline.
	
#### Prototyping result:
- ❌ Reduced descriptor set binding not really noticable. (even on older CPU's)
- ❌ VBO & IBO array only noticable on newer CPU's that are less bottlenecked.
- ❌ Older CPU's vary from less-or-equal to marginally improved framerates.
- ✅ Logic is somewhat simpler because omitted vertex/index/descriptor bindings commands
- ✅ Can be helpfull for future redesigns. 
- ✅ multi-threaded SPIR-V compiler

#### Conclusion: CPU is the current bottleneck (mostly Ghoul2 bone transforms)


---

