const logoInput = document.getElementById("logo-input");

console.log("Config");

const sendingData = async () => {
  let data = new FormData(document.getElementById("basic-conf"));
  console.log(data, "okay data");
  let response = await sendingRequest(data);
  console.log(response);
};

const sendingRequest = async (data) => {
  try {
    let req = await fetch(`${URL_SITE}/api/v1/markets/basic-config`, {
      method: "POST",
      body: data,
    });
    console.log(req);
    let json = await req.json();
    return json;
  } catch (err) {
    console.log(err);
    throw Error(err);
  }
};
