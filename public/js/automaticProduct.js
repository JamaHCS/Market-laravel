const submitBtn = document.getElementById("submit");
const barcodeInput = document.getElementById("barcodeInput");
const hiddenContainer = document.getElementById("automatic-result");
const finalForm = document.getElementById("final-form");
const nameInput = document.getElementById("name");
const barcodeI = document.getElementById("barcode");
const imageDefaultInput = document.getElementById("imageDefaultInput");
const imageDefault = document.getElementById("imageDefault");
const brandInput = document.getElementById("brand");
const typeInput = document.getElementById("type");

let product = {
  name: "",
  barcode: "",
  image: "",
  brand: "",
  type: "",
};

const submitAction = async () => {

  
  loader.classList.add("d-flex");

  let barcode = barcodeInput.value;
  console.log(barcode);

  await settingHiddenContainer(barcode).then((res) => {
    let titles = document.getElementsByTagName("title");
    let metaImage = metaTags.filter((val) => val.name == "twitter:image");
    let metaBrand = metaTags.filter((val) => val.name == "twitter:data1");
    let metaCategory = metaTags.filter((val) => val.name == "twitter:data2");

    product.name = titles[1].innerText;
    product.barcode = barcode;
    product.image ='https://fr-es.openfoodfacts.org/' + metaImage[0].content;
    product.type = metaCategory[0].content;
    product.brand = metaBrand[0].content;

    console.log(product);

    settingValues();

    return product;
  });
};

const settingHiddenContainer = async (value) => {
  let response = await fetch(
    `${URL_SITE}/api/v1/markets/barcode/${value}`
  ).then((res) => {
    loader.classList.remove("d-flex");
    return res.json();
  });

  hiddenContainer.innerHTML = response;
  metaTags = [...metas];
};

const settingValues = () => {
  nameInput.value = product.name;
  barcodeI.value = product.barcode;
  imageDefaultInput.value = product.image;
  imageDefault.src = product.image;
  brandInput.value = product.brand;
  typeInput.value = product.type;

  finalForm.classList.remove("d-none");
};
