// JavaScript
var themeElement = document.getElementById("themeText");
    
// Kiểm tra giá trị ban đầu của localStorage
if (localStorage.getItem("theme") === null) {
  localStorage.setItem("theme", "light");
}

// Cập nhật giá trị ban đầu từ localStorage
var currentTheme = localStorage.getItem("theme");
themeElement.setAttribute("data-bs-theme", currentTheme);

var toggleButton = document.getElementById("toggleButton");

// Xử lý sự kiện click
toggleButton.addEventListener("click", function() {
  var currentTheme = themeElement.getAttribute("data-bs-theme");
  
  if (currentTheme === "dark") {
    currentTheme = "light";
  } else {
    currentTheme = "dark";
  }
  
  // Lưu giá trị mới vào localStorage
  localStorage.setItem("theme", currentTheme);
  
  // Cập nhật giá trị thuộc tính data-bs-theme
  themeElement.setAttribute("data-bs-theme", currentTheme);
});