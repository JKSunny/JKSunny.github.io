### Physical Based Rendering (PBR)
	tags[pbr]
![](https://jksunny.github.io/assets/illustrations/pbr.jpg)


> **INFO:** Physically Based Rendering (PBR) is a rendering technique that aims to simulate the interaction between light and materials more accurately, resulting in more realistic visuals. <br> 
>	- Traditional rendering methods often relied on baked specular highlights, where the shine of surfaces was pre-computed and stored in the texture maps, leading to less realistic and static effects. <br> 
>	- PBR however, uses separate texture maps for different material properties;  albedo/diffuse (base color), metallic, roughness, and normal maps. This separation allows for more precise control over how materials react to lighting conditions in real time.

Implementation of [PBR](https://google.github.io/filament/Filament.html#materialsystem/parameterization/standardparameters) material system is based on [Rend2](https://github.com/SomaZ/OpenJK) renderer from OpenJK \
Adding the ability to apply *normal, roughness, metallic* or *specular* texture maps by introducing the [<kbd>.mtr</kbd>](https://jkhub.org/tutorials/rend2/new-shader-keywords-r98/) file extension, which is an override for [<kbd>.shader</kbd>](https://jkhub.org/tutorials/skinning/basics-of-skinning-03-shaders-r192/)

---

### Visualize PBR layers
	tags[inspector]
<iframe  style="width:100%; height:315px" src="https://www.youtube.com/embed/unpj0gQ1HgI" frameborder="0" allowfullscreen></iframe>		
Easy expandedable profiler

---

### Image Based Lighting (IBL)
	tags[pbr]
<iframe  style="width:100%; height:315px" src="https://www.youtube.com/embed/oTgeiTn6g4E" frameborder="0" allowfullscreen></iframe>

> **INFO:** IBL cubemaps use a six-sided texture to capture the surrounding environment of a point in world space. Basicly a 360° photo.<br>
Cubemaps are generated during map-loading and are later used to reproject on 3D surfaces in real-time, allowing for more realistic specular reflections, diffuse and ambient light sampling.<br> 
Being pre-computed during map-loading makes cubemaps static, but efficient.
In combination with PBR, cubemaps provide a fast way to light scenes by sampling reprojected pre-computed (static) environmental textures.

Implementation of IBL is based the on [Rend2](https://github.com/SomaZ/OpenJK) renderer from OpenJK. \
256x256 pixel dimensions are used.

---

### ImGui Implementation
	tags[inspector]

Dear ImGui is a **bloat-free graphical user interface library for C++**. It outputs optimized vertex buffers that you can render anytime in your 3D-pipeline-enabled application. It is fast, portable, renderer agnostic, and self-contained (no external dependencies).

Dear ImGui is designed to **enable fast iterations** and to **empower programmers** to create **content creation tools and visualization / debug tools** (as opposed to UI for the average end-user). It favors simplicity and productivity toward this goal and lacks certain features commonly found in more high-level libraries. Among other things, full internationalization (right-to-left text, bidirectional text, text shaping etc.) and accessibility features are not supported.

Dear ImGui is particularly suited to integration in game engines (for tooling), real-time 3D applications, fullscreen applications, embedded applications, or any applications on console platforms where operating system features are non-standard.

 - Minimize state synchronization.
 - Minimize UI-related state storage on user side.
 - Minimize setup and maintenance.
 - Easy to use to create dynamic UI which are the reflection of a dynamic data set.
 - Easy to use to create code-driven and data-driven tools.
 - Easy to use to create ad hoc short-lived tools and long-lived, more elaborate tools.
 - Easy to hack and improve.
 - Portable, minimize dependencies, run on target (consoles, phones, etc.).
 - Efficient runtime and memory consumption.
 - Battle-tested, used by [many major actors in the game industry](https://github.com/ocornut/imgui/wiki/Software-using-dear-imgui).

[source](https://github.com/ocornut/imgui/)

[![pbr-inspector-devlogs](https://img.shields.io/badge/See-Devlog_videos-yellow.svg)](https://www.youtube.com/playlist?list=PLK0BIdk-GT_erDdqgLrzhGbpeIXZVRHL0)

---

### Resizable Viewport
	tags[inspector]	
<iframe  style="width:100%; height:315px" src="https://www.youtube.com/embed/4U2fl-1mq1I" frameborder="0" allowfullscreen></iframe>

---

### Profiler
	tags[inspector]
<iframe  style="width:100%; height:315px" src="https://www.youtube.com/embed/w681g_al3bw" frameborder="0" allowfullscreen></iframe>		

**Legit profiler**: ImGui helper class for simple profiler histogram<br />
[Repository](https://github.com/Raikiri/LegitProfiler) - 
[License](https://github.com/Raikiri/LegitProfiler/blob/master/LICENSE.txt)

---

### Shader preview and editor
	tags[inspector]
![md_ba](https://jksunny.github.io/assets/illustrations/shader-editor0.jpg)
![](https://jksunny.github.io/assets/illustrations/shader-editor1.jpg)	

**ImGuiColorTextEdit**: Syntax highlighting text editor for ImGui<br />
[Repository](https://github.com/BalazsJako/ImGuiColorTextEdit) - 
[License](https://github.com/BalazsJako/ImGuiColorTextEdit/blob/master/LICENSE)

**ImNodeFlow**: Node-based editor/blueprints for ImGui<br />
[Repository](https://github.com/Fattorino/ImNodeFlow) - 
[License](https://github.com/Fattorino/ImNodeFlow/blob/master/LICENSE.txt)

**NetRadiant-custom**: The open-source, cross-platform level editor for id Tech based games.<br />
*- As Inspiration for auto-complete -*<br />
[Commit](https://github.com/Garux/netradiant-custom/commit/9c2fbc9d1dd4029c0f76aec2830f991fcb2c259e) -
[Repository](https://github.com/Garux/netradiant-custom/tree/master) -
[License](https://github.com/Raikiri/LegitProfiler/blob/master/LICENSE.txt)

---

### RTX
	tags[rtx]
<iframe style="width:100%; height:315px" src="https://www.youtube.com/embed/?listType=playlist&list=PLK0BIdk-GT_dPJyqZGN72nJ3PWv79XUw-" frameborder="0" allowfullscreen></iframe>
 
> **NOTE** This is Work-in-progress, and is unstable. \
> E.g. switching map requires a full restart because buffer clearing is not implemented yet.

I wanted to learn more on the topic of RayTracing. \
The current implementation is not yet complete, but the essential functionality should be there. \
It needs more TLC, due to time constraints I have decided to put this project on hold.

I believe its a waste to let this codebase collect dust, and decided to share it. \
Because the Jedi Knight community remains highly active, with further development, this project <ins>could</ins> become stable and playable, either through my efforts or with your involvement. 

I used [Quake-III-Arena-R](https://github.com/fknfilewalker/Quake-III-Arena-R) as a starting point, however transitioned to [Q2RTX](https://github.com/NVIDIA/Q2RTX) relativly quickly. \
[Q2RTX](https://github.com/NVIDIA/Q2RTX) is active and receives frequent updates. \
Also the code base is very clear plus I like the RayTraced result!
I can highly recommend you to give their great effort a try if you have not done so already.

**Main differences in this codebase:**

> Q2RTX implemented their own material system. \
> However I wanted to use the native .shader and support the .mtr material system from **Rend2** \
> I did a quick mockup of that, I have not added multistage support yet.

> Ghoul2 support is added *(No MD3 yet)*, and uses the same IBO's and VBO's used for **Beta** and **PBR** branch with minor tweaks. \
> Q2RTX uses a single buffer for the IBO and VBO and does not have Ghoul2 support. \
> I did port this method, but it is define guarded and can safely be removed.

> BSP level loading and buffers differ. \
> This should however be looked at and transitioned to Q2RTX method of tlas and blas creation *(top/bottom level accel structure)*

> **GETTING STARTED** \
> Set cvar r_normalMapping 1, r_specularMapping 1, r_cubeMapping 0, r_hdr 0, r_fullscreen 1 and r_vertexLight 2 
> Everything is define guarded using **USE_RTX** in the codebase

> **IMPORTANT** Requires assets from [Q2RTX on Steam](https://store.steampowered.com/app/1089130/Quake_II_RTX/) \
> Download and locate the install folder and open baseq2 folder \
> Locate and open blue_noise.pkz and copy the folder "blue_noise" to the base folder of your Jedi Academy install folder. \
> Do the same for the folder "env" in q2rtx_media.pkz. \
> You should now have the following file structure: GameData/base/blue_noise and GameData/base/env \
> *~ Give Q2RTX a try as well*

Sources: \
[Quake-III-Arena-R](https://github.com/fknfilewalker/Quake-III-Arena-R) \
[Q2RTX](https://github.com/NVIDIA/Q2RTX) - [License](https://github.com/NVIDIA/Q2RTX/blob/master/license.txt)

References: \
[Vulkan Specification](https://registry.khronos.org/vulkan/specs/1.2-extensions/html/vkspec.html) \
[SaschaWillems - Vulkan](https://github.com/SaschaWillems/Vulkan)

---

### Dynamic glow
	tags[all]
![md_ba](https://jksunny.github.io/assets/illustrations/dglow0.jpg)
![](https://jksunny.github.io/assets/illustrations/dglow1.jpg)

> **r_DynamicGlow**

> **r_DynamicGlowAllStages** - Vanilla renderer skips certain collapsed glow stages. Render these anyway [(3e62987)
](https://github.com/JKSunny/EternalJK/commit/3e62987235a820df146da90520b73b6fb3844bfe)


> **r_DynamicGlowPasses** unused

> **r_DynamicGlowDelta** unused

> **r_DynamicGlowIntensity** unused

> **r_DynamicGlowSoft** unused

> **r_DynamicGlowWidth** unused

> **r_DynamicGlowHeight** unused

> **r_DynamicGlowScale** unused

---

### Features from Quake3e
	tags[all]
- [x] high-quality per-pixel dynamic lighting
- [x] very fast flares (**\r_flares 1**)
- [x] anisotropic filtering (**\r_ext_texture_filter_anisotropic**)
- [x] greatly reduced API overhead (call/dispatch ratio)
- [x] flexible vertex buffer memory management to allow loading huge maps
- [x] multiple command buffers to reduce processing bottlenecks
- [ ] [reversed depth buffer](https://developer.nvidia.com/content/depth-precision-visualized) to eliminate z-fighting on big maps
- [x] merged lightmaps (atlases)
- [x] multitexturing optimizations
- [x] static world surfaces cached in VBO (**\r_vbo 1**)
- [x] useful debug markers for tools like [RenderDoc](https://renderdoc.org/)
- [x] fixed framebuffer corruption on some Intel iGPUs
- [x] offscreen rendering, enabled with **\r_fbo 1**, all following requires it enabled:
- [x] `screenMap` texture rendering - to create realistic environment reflections
- [x] multisample anti-aliasing (**\r_ext_multisample**)
- [ ] supersample anti-aliasing (**\r_ext_supersample**)
- [x] per-window gamma-correction which is important for screen-capture tools like OBS
- [ ] you can minimize game window any time during **\video**|**\video-pipe*- [x]recording
- [x] high dynamic range render targets (**\r_hdr 1**) to avoid color banding
- [x] bloom post-processing effect
- [x] arbitrary resolution rendering
- [x] greyscale mode

Source: [Quake3e](https://github.com/ec-/Quake3e?tab=readme-ov-file#vulkan-renderer)

---

### Refraction
	tags[all]
![md_ba](https://jksunny.github.io/assets/illustrations/refractrion0.jpg)
![](https://jksunny.github.io/assets/illustrations/refractrion1.jpg)

Refraction method ported from Rend2

---

### Offscreen rendering - FBO
	tags[all]
> **INFO:** An offscreen FBO (Frame Buffer Object) is used to render to a separate image or texture that is not directly displayed on the screen. This allows for techniques like post-processing effects or rendering to textures for later use. On the other hand, a non-FBO approach involves rendering directly to the swapchain (screen), which is suitable for simple rendering scenarios without the need for offscreen rendering or additional processing.

**Enable for:**

- Dynamic glow
- Multisample anti-aliasing (MSAA)
- Bloom
- Refraction

> - PBR branches have this enabled hard-coded

> **r_fbo**
---

### Static World surface caching - VBO
	tags[all]
> **INFO:** VBO (Vertex Buffer Object) caching is a technique used to optimize rendering performance for static surfaces. By storing vertex data in a VBO on the GPU, it can be efficiently reused across multiple draw calls, reducing the overhead of transferring data to the GPU. This is particularly beneficial for surfaces that do not change frequently, as it minimizes the CPU to GPU communication and improves overall rendering efficiency.

> PBR branches have this enabled hard-coded

- Native master branch implements VBO caching for static world surfaces.

> PBR branches have this enabled hard-coded \
> Beta branch adds support for Ghoul2 and MD3 models. 

> **r_vbo** - Cache static surfaces: \
	0 : off \
	1 : world
---

### Lightmap atlasing
	tags[all]
![md_ba](https://jksunny.github.io/assets/illustrations/lightmap0.jpg)
![](https://jksunny.github.io/assets/illustrations/lightmap1.jpg)

> **INFO:** Lightmaps are baked textures used to simulate lighting in 3D environments.
They store information about how light interacts with surfaces, such as shadows and color variations.
By applying these lightmaps to static world surfaces, it can achieve a more visually appealing environment.

- Vanilla renderer uses individual lightmaps.
- Copies of a .shader entry (material) live in memory seperately for surfaces not sharing a lightmap.
- Only surfaces sharing a .shader entry (same lightmap) in memory, can be merged.

**Vulkan renderer** merges multiple lightmaps into texture atlases, increasing mergeability of surfaces thus reducing GPU drawcalls

---

### Model surface caching - VBO
	tags[beta,pbr]
In addition to static world surfaces support for Ghoul2 (player) and MD3 models is added.

- Bone matrices are transformed on the GPU.
- Use indirect drawing instead of indexed
- Colors and deformed texture coordinated, are no longer pre-calculated by the CPU but happen on the GPU directly.


> Enabled hard-coded on PBR branches

> **r_vbo** - Cache static surfaces: \
	0 : off \
	1 : world \
	2 : world + models
---


### Bloom
	tags[all]
![md_ba](https://jksunny.github.io/assets/illustrations/bloom0.jpg)
![](https://jksunny.github.io/assets/illustrations/bloom1.jpg)

> **r_bloom**

> **r_bloom_threshold** - Color level to extract to bloom texture, default is 0.05 

> **r_bloom_intensity** - Final bloom blend factor, default is 0.15

> **r_bloom_threshold_mode** - 
> Color extraction mode: \
	0 : ( r | g | b ) >= threshold \
	1 : ( r + g + b ) / 3 >= threshold \
	2 : luma( r, g, b ) >= threshold

> **r_bloom_modulate** - 
> Modulate extracted color: \
	0 : off (color = color, i.e. no changes) \
	1 : by itself (color = color * color) \
	2 : by intensity (color = color * luma(color))
---

### Multisample anti-aliasing (MSAA)
	tags[all]
![md_ba](https://jksunny.github.io/assets/illustrations/msaa0.jpg)
![](https://jksunny.github.io/assets/illustrations/msaa1.jpg)

---
