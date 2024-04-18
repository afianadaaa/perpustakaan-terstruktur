<!-- <p>COOKIE STORED:</p>
<textarea name="" id="mycookie" cols="100" rows="10"></textarea> -->

<script>
  function update_cookie(){
    const decodedString = decodeURIComponent(getCookie('cart'));
    const mycart = JSON.parse(decodedString);
    document.getElementById("mycookie").value = decodedString;
  }
  function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {return parts.pop().split(';').shift();}
  }
  function setCookie(){
    // Select all elements with the class 'cart-data'
    const cartDataRows = document.querySelectorAll('.cart-data');

    // Initialize an empty array to store the data
    const dataArray = [];

    // Loop through each row
    cartDataRows.forEach(row => {
        // Get values from each row
        const id = row.querySelector('.id').textContent;
        const judul = row.querySelector('.judul').textContent;
        const lamaPeminjaman = row.querySelector('.lama_peminjaman').value;

        // Push values to the dataArray
        dataArray.push([ id, judul, lamaPeminjaman ]);
    });

    // Convert the dataArray to JSON
    const jsonData = encodeURIComponent(JSON.stringify(dataArray));

    // Check if the 'cart' cookie already exists
    const existingCart = getCookie('cart');

    document.cookie = `cart=${jsonData}; path=/perpustakaan_terstruktur/pinjam`;

    //update_cookie()
  }
  //update_cookie()
  //Uncomment baris 1,2,41,43 untuk lihat perubahan cookie secara langsung
</script>