import { AppController } from "./controller/app-controller.js";
import { Dropzone } from "./model/dropzone.js";
import { Filelist } from "./model/filelist.js";
import { Form } from "./model/form.js";

window.onload = () => {
  const appController = new AppController({
    form: new Form("form"),
    dropzone: new Dropzone("[data-dropzone]"),
    filelist: new Filelist("[data-filelist]")
  })
}