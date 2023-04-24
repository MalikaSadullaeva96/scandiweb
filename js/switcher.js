import createInputLabelPair from './create_select_option.js';
import createDiv from './create_div.js'

let elements;
const form = document.getElementById('product_form');
const productType = document.getElementById('productType');
const option = document.querySelector('.main-add__option');

function switchOption() {
  option.innerHTML = '';
  switch(productType.value) {
    case 'DVD':
      elements = createInputLabelPair('size', 'Size (MB)', 'number');
      const dvdDiv = createDiv('main-add__type', elements.label, elements.input);
      option.append(dvdDiv);
      break;
    case 'Book':
      elements = createInputLabelPair('weight', 'Weight (Kg)', 'number');
      const bookDiv = createDiv('main-add__type', elements.label, elements.input);
      option.append(bookDiv);
      break;  
    case 'Furniture':
      const height = createInputLabelPair('height', 'Height (CM)', 'number');
      const width = createInputLabelPair('width', 'Width (CM)', 'number');
      const length = createInputLabelPair('length', 'Length (CM)', 'number');
      const heightDiv = createDiv('main-add__type', height.label, height.input);
      const widthDiv = createDiv('main-add__type', width.label, width.input);
      const lengthDiv = createDiv('main-add__type', length.label, length.input);
      option.append(heightDiv, widthDiv, lengthDiv);      
      break;
  }
 
}
productType.addEventListener('change', switchOption);
export default switchOption;
