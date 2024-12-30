## FAQ

**Q: How to enable the Vulkan renderer?**

**A:** Certain mods allow you to do this in the game menu. \
This is a convenient way to toggle the "cl_renderer" cvar.\
To do this manually, or on a mod that has no built-in option in the menu; \
1. Open up the console by pressing <kbd>~ Tilde</kbd> key
2. Type "cl_renderer rd-vulkan; vid_restart" and hit enter

---

**Q: How to check if the game is running on Vulkan?**

**A:** In the console, type either ```vkinfo``` or ```gfxinfo``` and hit enter. \
If ```vkinfo``` prints out GPU usage information instead of ```Unknown command vkinfo```, the renderer is properly initialized.\
Driver and API versions and available extensions can be printed using ```gfxinfo```. This is also the case for the Vanilla renderer

---

**Q: Is Single Player supported?**

**A:** No.