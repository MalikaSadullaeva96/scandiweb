import switchOption from './switcher.js';

const saveBtn = document.querySelector(".header__btn");
const form = document.querySelector(".main-add__form1");

saveBtn.addEventListener("click", () => {
    form.submit();
});