export class AppController {
  #form;
  #dropzone;
  #filelist;

  #files;

  constructor({ form, dropzone, filelist }) {
    this.#form = form;
    this.#dropzone = dropzone;
    this.#filelist = filelist;

    this.#files = [];

    this.init();
  }

  onFormReset() {
    this.#filelist.clean();
    this.#files = [];
  }

  onFormSubmit(formData) {
    if (!this.#files.length) {
      alert("Please send at least one image!");
      return;
    }

    for (const file of this.#files) {
      formData.append("images[]", file);
    }

    this.#form.setIsLoading(true);

    fetch("/image-resizer/resizer/", {
      method: "POST",
      body: formData
    }).then(response => response.blob())
      .then(blob => {
        const url = window.URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = 'images.zip';
        document.body.appendChild(a);
        a.click();

        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);

        this.#form.setIsLoading(false);
        this.#files = [];
        this.#filelist.clean();
      })
  }

  onDeleteFile(name) {
    this.#files = this.#files.filter((file) => file.name != name)

  }

  onDropFiles(files) {
    const recievedFiles = [...files];
    if (recievedFiles.some(item => !item.type.includes("image"))) {
      alert("Please send images only!");
      return;
    }

    this.#files = [...this.#files, ...recievedFiles];

    recievedFiles.forEach((file) => {
      this.#filelist.add(file, () => {
        this.onDeleteFile(file.name)
      });
    })

  }

  init() {
    this.#dropzone.configure(this.onDropFiles.bind(this));
    this.#form.configure(this.onFormSubmit.bind(this), this.onFormReset.bind(this));
  }

}