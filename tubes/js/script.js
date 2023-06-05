// Ambil elemen input pencarian
const searchInput = document.querySelector('input[name="keyword"]');
const keywordPlaceholder = document.getElementById("keyword-placeholder");

// Tambahkan event listener untuk input pencarian
searchInput.addEventListener("input", function () {
  // Ambil nilai input pencarian
  const keyword = this.value;

  // Perbarui teks pada elemen nama kategori
  keywordPlaceholder.textContent = keyword;

  // Buat request AJAX ke server untuk mendapatkan hasil pencarian
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `search.php?keyword=${keyword}`, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Tangkap hasil pencarian dari server
      const searchResults = xhr.responseText;

      // Tampilkan hasil pencarian di elemen search-results
      const searchResultsContainer = document.getElementById("search-results");
      searchResultsContainer.innerHTML = searchResults;
    }
  };
  xhr.send();
});
