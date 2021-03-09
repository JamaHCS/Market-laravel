const URL_SITE = window.location.origin;
let metas = document.getElementsByTagName("meta");
const metaTags = [...metas];
let csrf = metaTags.filter((e) => e.name === "csrf-token")[0];

const test = () => {
  alert("test okay");
};
