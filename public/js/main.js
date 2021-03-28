const URL_SITE = window.location.origin;
const loader = document.getElementById("loader");

let metas = document.getElementsByTagName("meta");
let metaTags = [...metas];
let csrf = metaTags.filter((e) => e.name === "csrf-token")[0];

const test = () => {
  alert("test okay");
};
