export class Dropzone {
  #dropzone;

  constructor(el) {
    this.#dropzone = document.querySelector(el);
  }

  onOver(e) {
    e.preventDefault();
    e.target.style.borderColor = "#0284c7";
  }

  onLeave(e) {
    e.target.style.borderColor = "#f1f5f9";
  }

  configure(callback) {
    if (this.#dropzone) {
      this.#dropzone.addEventListener('dragover', this.onOver);
      this.#dropzone.addEventListener('dragleave', this.onLeave);

      this.#dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        this.onLeave(e);

        callback(e.dataTransfer.files);
      });
    }
  }
}