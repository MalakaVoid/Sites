const input = document.querySelector(".img-file");
const preview = document.querySelector(".preview");

input.addEventListener("change", updateImageDisplay);

function updateImageDisplay() {
  while (preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }

  const curFiles = input.files;
  if (curFiles.length === 0) {
    const para = document.createElement("p");
    para.textContent = "Файл не загружен!";
    preview.appendChild(para);
  } else {

    for (const file of curFiles) {
    //   const listItem = document.createElement("div");
      const para = document.createElement("p");
      if (validFileType(file)) {
        para.textContent = `File name ${file.name}, file size ${returnFileSize(
          file.size,
        )}.`;
        const image = document.createElement("img");
        image.src = URL.createObjectURL(file);
        image.alt = image.title = file.name;

        preview.appendChild(image);
        preview.appendChild(para);
      } else {
        para.textContent = `Файл ${file.name}: не правильного расширения! Выберите расширение PNG.`;
        preview.appendChild(para);
      }
    }
  }
}

const fileTypes = [
  "image/png",
];

function validFileType(file) {
  return fileTypes.includes(file.type);
}

function returnFileSize(number) {
  if (number < 1024) {
    return `${number} bytes`;
  } else if (number >= 1024 && number < 1048576) {
    return `${(number / 1024).toFixed(1)} KB`;
  } else if (number >= 1048576) {
    return `${(number / 1048576).toFixed(1)} MB`;
  }
}
