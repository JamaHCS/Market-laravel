const searchButton = document.getElementById("searchButton");
const toSearch = document.getElementById("search");
const tbody = document.getElementById("tbody");
const formtBody = document.getElementById("formtBody");
const marketId = document.getElementById("market_id");
// const finalForm = document.getElementById("sell_elements");
const formState = document.getElementById("formState");
const totalt = document.getElementById("total");

let productsGotten = [];
let state = [];
let total = 0;

const getProduct = async () => {
  try {
    let data = new FormData(document.getElementById("formSearch"));

    let req = await fetch(`${URL_SITE}/api/v1/product`, {
      method: "POST",
      body: data,
    });

    let json = await req.json();

    console.log("req: ", json);

    tbody.innerHTML = "";

    json.forEach((el) => {
      tbody.innerHTML += getTemplate(
        el.id,
        el.image,
        el.name,
        el.price,
        el.stock
      );
    });

    $("#modalSells").modal();
  } catch (err) {
    console.log("error: ", err);
    throw Error(err);
  }
};

const setState = (id) => {
  let quant = prompt("Inserte la cantidad, por favor");
  state.push({ id: id, quant: quant });
  elementsDidUpdate();
};

const getTemplate = (id, img, name, price, stock) => {
  if (stock > 0) {
    return `
              <tr>
                <td>${id}</td>
                <td>
                  <div class="container-image-product">
                    <img src="${img}" class="img-product">
                  </div>
                </td>
                <td>${name}</td>
                <td>$ ${price}</td>
                <td>
                  <button type="button" class="btn btn-success" data-dismiss="modal" onclick="setState(${id})">Agregar</button>
                </td>
              </tr>
  `;
  } else {
    return `
              <tr>
                <td>${id}</td>
                <td>
                  <div class="container-image-product">
                    <img src="${img}" class="img-product">
                  </div>
                </td>
                <td>${name}</td>
                <td>$ ${price}</td>
                <td>
                  <button type="button" class="btn btn-success" data-dismiss="modal" disabled>Agregar</button>
                </td>
              </tr>
  `;
  }
};

const elementsDidUpdate = () => {
  formtBody.innerHTML = "";
  total = 0;

  state.forEach((el) => {
    let producta = PRODUCTS.filter((val) => val.id == el.id);
    console.log("state: ", producta);

    formtBody.innerHTML += getTemplateElements(
      producta[0].id,
      producta[0].image,
      producta[0].name,
      producta[0].price,
      el.quant
    );

    formState.value = JSON.stringify(state);
  });
};

const getTemplateElements = (id, img, name, price, quant) => {
  let subtotal = quant * price;

  total += subtotal;
  totalt.innerText = "$" + total;

  return `
    <tr>
                <td>${id}</td>
                <td>
                  <div class="container-image-product">
                    <img src="${img}" class="img-product">
                  </div>
                </td>
                <td>${name}</td>
                <td>$ ${price}</td>
                <td>${quant}</td>
                <td>$ ${subtotal}</td>
              </tr>
  `;
};
