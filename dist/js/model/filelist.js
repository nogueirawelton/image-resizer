export class Filelist {
  #el;

  constructor(el) {
    this.#el = document.querySelector(el);
  }

  clean() {
    this.#el.innerHTML = "";
  }

  add(file, deleteCallback) {
    const tmpURL = URL.createObjectURL(file);
    const div = document.createElement("div");

    const content = `
      <button data-file class="w-8 grid place-items-center right-2 top-2 h-8 rounded-full bg-black/50 absolute lg:opacity-0 group-hover:opacity-100 transition-all duration-500">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" viewBox="0 0 256 256"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
      </button>
      <img src="${tmpURL}" class="w-full aspect-square object-cover"/>
    `

    div.innerHTML = content;
    div.classList.add("group", "relative");

    div.querySelector("button").addEventListener("click", (e) => {
      e.currentTarget.parentElement.remove();
      deleteCallback();
    })

    this.#el.appendChild(div);
  }
}