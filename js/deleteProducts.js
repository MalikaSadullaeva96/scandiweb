function removeProducts() {
    const checkedCheckboxes = document.querySelectorAll('.delete-checkbox:checked');
  
    if (checkedCheckboxes.length > 0) {

      const skuList = Array.from(checkedCheckboxes).map(checkbox => checkbox.dataset.sku);
      deleteProductsFromServer(skuList);
      console.log(skuList);
    } else {
      alert('Please select at least one product to delete.');
    }
  }
  
  function deleteProductsFromServer(skuList) {
    const formData = new FormData();
    formData.append('delete', '1');
    formData.append('skuList', skuList.join(','));
  
    fetch('./php/insert.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => {
        console.log('Raw server response:', response);
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text();
      })
      .then(data => {
        console.log('Response data:', data);
        if (data === 'success') {
          console.log('Products deleted successfully.');
          window.location.reload();
        } else {
          console.error('Error deleting products:', data);
        }
      })
      .catch(error => {
        console.error('Error deleting products:', error);
      });
  }

const deleteProductBtn = document.getElementById('delete-product-btn');
deleteProductBtn.addEventListener('click', removeProducts);
export default removeProducts;
  