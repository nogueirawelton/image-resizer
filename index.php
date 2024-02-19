<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image Resizer</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex flex-col">
  <header class="h-24 bg-zinc-900 shrink-0">
    <div class="max-w-screen-xl flex items-center text-zinc-100 h-full mx-auto px-4 md:px-8">
      <h1 class="font-bold text-2xl">Image Resizer</h1>
    </div>
  </header>

  <main class="bg-zinc-800 flex-1">
    <div class="max-w-screen-xl flex gap-8 flex-col mx-auto px-4 md:px-8 py-12 h-full">
      <form class="grid grid-cols-1 lg:grid-cols-2 gap-8" action="http://localhost/image-resizer/" method="POST" enctype="multipart/form-data">
        <div data-dropzone class="min-h-[240px] lg:h-full transition-all duration-500 w-full flex items-center justify-center flex-col gap-4 text-zinc-100 h-full border rounded-md border-dashed border-zinc-100">
          <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="#f1f5f9" viewBox="0 0 256 256">
            <path d="M200,32H163.74a47.92,47.92,0,0,0-71.48,0H56A16,16,0,0,0,40,48V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V48A16,16,0,0,0,200,32Zm-72,0a32,32,0,0,1,32,32H96A32,32,0,0,1,128,32Zm72,184H56V48H82.75A47.93,47.93,0,0,0,80,64v8a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V64a47.93,47.93,0,0,0-2.75-16H200Z"></path>
          </svg>

          <span>Drop images to resize</span>
        </div>

        <div class="flex flex-col gap-12">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <strong class="text-zinc-100 text-lg">Desktop</strong>

              <div class="flex flex-col gap-4 mt-4">
                <input class="h-12 px-4 bg-zinc-700 rounded-md text-zinc-100" value="1920" min="425" max="1920" name="desktop_width" type="number" placeholder="Width">
                <input class="h-12 px-4 bg-zinc-700 rounded-md text-zinc-100" min="240" max="1080" name="desktop_height" type="number" placeholder="Height">
                <input class="h-12 px-4 bg-zinc-700 rounded-md text-zinc-100" value="90" max="100" name="desktop_quality" type="number" placeholder="Quality">
              </div>
            </div>
            <div>
              <strong class="text-zinc-100 text-lg">Mobile</strong>

              <div class="flex flex-col gap-4 mt-4">
                <input class="h-12 px-4 bg-zinc-700 rounded-md text-zinc-100" value="425" min="425" max="1920" name="mobile_width" type="number" placeholder="Width">
                <input class="h-12 px-4 bg-zinc-700 rounded-md text-zinc-100" min="240" max="1080" name="mobile_height" type="number" placeholder="Height">
                <input class="h-12 px-4 bg-zinc-700 rounded-md text-zinc-100" value="80" max="100" name="mobile_quality" type="number" placeholder="Quality">
              </div>
            </div>
          </div>

          <div class="flex items-center gap-4">
            <button type="submit" class="h-12 group w-[155px] flex items-center justify-center px-4 [&.loading]:cursor-not-allowed [&.loading]:opacity-75 rounded-md text-white font-medium bg-sky-600">
              <span class="group-[&.loading]:hidden">Generate Images</span>

              <svg class="animate-spin group-[&.loading]:block hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffffff" viewBox="0 0 256 256">
                <path d="M232,128a104,104,0,0,1-208,0c0-41,23.81-78.36,60.66-95.27a8,8,0,0,1,6.68,14.54C60.15,61.59,40,93.27,40,128a88,88,0,0,0,176,0c0-34.73-20.15-66.41-51.34-80.73a8,8,0,0,1,6.68-14.54C208.19,49.64,232,87,232,128Z"></path>
              </svg>
            </button>
            <button type="reset" class="h-12 px-4 rounded-md text-white font-medium bg-red-600">Reset</button>
          </div>
        </div>

      </form>

      <div class="flex-1 flex h-full flex-col gap-4">
        <strong class="text-zinc-100 text-lg">Images</strong>

        <div data-filelist class="min-h-[240px] grid-cols-2 lg:h-full w-full grid md:grid-cols-3 lg:grid-cols-6 gap-2 p-2 h-full rounded-md bg-zinc-700">

        </div>
      </div>
    </div>
  </main>

  <script src="dist/js/app.js" type="module"></script>
</body>

</html>