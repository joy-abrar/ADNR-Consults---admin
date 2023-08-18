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

/* ------------------------ SEARCHBAR2 FUNCTION --------------------- */
function myFunction2() 
{
  // Declare variables
  var searchBox, filter, table, tr, td, i, txtValue;
  searchBox = document.getElementById('mySearchBox2');
  filter = searchBox.value.toUpperCase();
  table = document.getElementById("myTable2");
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

/* ------------------------ END SEARCHBAR2 FUNCTION --------------------- */

 /* --------------------------- LOADING SCREEN SCRIPT -------------------- */
$(window).load(function() 
{
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");
});
/* -------------------- END LOADING SCREEN SCRIPT -------------------- */




/* -----------------------------SHOW IMAGE -------------------- */

function debugBase64(base64URL)
{
    //console.log(base64URL);
    var win = window.open();
    win.document.write('<iframe src="' + base64URL  + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');
}

/* -----------------------------SHOW IMAGE -------------------- */