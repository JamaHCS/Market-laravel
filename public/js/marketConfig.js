const logoInput = document.getElementById("logo-input");
const updated = document.getElementById("updated");

console.log("Config");

const sendingData = async () => {
  let data = new FormData(document.getElementById("basic-conf"));
  console.log(data, "okay data");

  let response = await sendingRequest(data);
  console.log(response);

  if (response) {
    updateAnimation();
  }
};

const sendingRequest = async (data) => {
  try {
    let req = await fetch(`${URL_SITE}/api/v1/markets/basic-config`, {
      method: "POST",
      body: data,
    }).then((response) => {
      updated.classList.add("show");
      return response;
    });

    console.log(req);
    let json = await req.json();

    return json;
  } catch (err) {
    console.log(err);
    throw Error(err);
  }
};

const updateAnimation = () => {
  setTimeout(() => {
    updated.classList.remove("show");
  }, 4000);
};
