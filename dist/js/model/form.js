export class Form {
  #el;

  constructor(el) {
    this.#el = document.querySelector(el);
  }

  setIsLoading(isLoading) {
    const button = document.querySelector("button[type='submit']");

    if (isLoading) {
      button.classList.add("loading");
      button.setAttribute("disabled", "");

      return;
    }

    button.classList.remove("loading");
    button.removeAttribute("disabled", "");
  }

  configure(submitCallback, resetCallback) {
    this.#el.addEventListener("submit", (e) => {
      e.preventDefault();
      const formData = new FormData(e.target);

      submitCallback(formData);
    })

    this.#el.querySelector("button[type='reset']").addEventListener("click", () => {
      resetCallback()
    })
  }
}