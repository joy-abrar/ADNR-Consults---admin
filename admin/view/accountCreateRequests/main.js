/* ------------------------ SEARCHBAR FUNCTION --------------------- */
function myFunction() 
{
  // Declare variables
  var searchBox, filter, table, tr, td, i, txtValue;
  searchBox = document.getElementById('mySearchBox');
  filter = searchBox.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName('tr');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) 
  {
    /* --------- SEARCH BY LASTNAME ----------------*/
    td = tr[i].getElementsByTagName("td")[0];
    txtValue = td.textContent || td.innerText;
    
    td2 = tr[i].getElementsByTagName("td")[1];
    txtValue2 = td2.textContent || td2.innerText;

    if (txtValue.toUpperCase().indexOf(filter) > -1) 
    {
      tr[i].style.display = "";
    } 

    else if (txtValue2.toUpperCase().indexOf(filter) > -1) 
    {
      tr[i].style.display = "";
    }

    else 
    {
      tr[i].style.display = "none";
    }
  }
}

/* ------------------------ END SEARCHBAR FUNCTION --------------------- */

 /* --------------------------- LOADING SCREEN SCRIPT -------------------- */
$(window).load(function() 
{
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
});
/* -------------------- END LOADING SCREEN SCRIPT -------------------- */