function filterString(){
    var input, tdLink, toFilter, table, tr, row, txtLink, tdCategory, txtCategory;
    // var differentFilter, filter;
    // differentFilter = document.getElementById('searchedCategory');
    // if(differentFilter.getElementById("filteredCategory")){
    //
    //     differentFilter = differentFilter.getElementById("filteredCategory");
    //     filter = differentFilter.innerText;
    //     if(filter){
    //         filterCategory(filter);
    //     }
    // }
    input       = document.getElementById('filterInput');
    toFilter    = input.value.toLowerCase();
    table       = document.getElementsByTagName('table')[0];
    tr          = table.getElementsByTagName('tr');
    for(row = 0; row < tr.length; row++){
        tdLink      = tr[row].getElementsByTagName('td')[0];
        if(tdLink){
            txtLink     = tdLink.textContent    || tdLink.innerText;
            if (txtLink.toLowerCase().indexOf(toFilter) > -1) {
                tr[row].style.display = '';
            }
            else {
                tr[row].style.display = 'none';
                tdCategory = tr[row].getElementsByTagName('td')[1];
                if(tdCategory){
                    txtCategory = tdCategory.textContent || tdCategory.innerText;
                    // if(differentFilter === ''){
                        if(txtCategory.toLowerCase().indexOf(toFilter) > -1){
                            tr[row].style.display = '';
                        }
                    // }

                }
            }
        }

    }
}


function filterCategory(element){
    var tdCategory, txtCategory, toFilter, table, tr, row;
    toFilter = element;
    if(element.tagName === 'BUTTON'){
        toFilter    = element.value;
    }
    table       = document.getElementsByTagName('table')[0];
    tr          = table.getElementsByTagName('tr');
    document.getElementById('searchedCategory').innerHTML = 'Es wird nach der Kategorie <b id="filteredCategory">' + toFilter + '</b> gesucht!';
    for(row = 0; row < tr.length; row++) {
        tdCategory  = tr[row].getElementsByTagName('td')[1];
        if(tdCategory){
            txtCategory = tdCategory.textContent    || tdCategory.innerText;
            if(txtCategory.indexOf(toFilter) > -1){
                tr[row].style.display   = '';
            }
            else{
                tr[row].style.display   = 'none';
            }
        }
    }
}

function favorite(element){
    var searchClass, toSearch;
    toSearch = 'addFavorite';
    var xhr = new XMLHttpRequest();
    xhr.open('POST','http://localhost/Aufgaben/LinksV2/index.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function favorite(){
        // console.log(xhr.readyState, xhr);
        if(xhr.status === 200){
            console.log(xhr);
        }
    }
    searchClass = element.className.search(toSearch);
    if( searchClass === 11){
        xhr.send("user[deleteFav]="+element.value);
    }
    if(searchClass === -1){
        xhr.send("user[addFav]="+element.value);
    }
    element.classList.toggle('addFavorite');
}

function addToAllFavoritesClass(){
    var tdButton, button, table, tr, row;
    table   = document.getElementById('favTable');
    tr      = table.getElementsByTagName('tr');
    for(row = 0; row < tr.length; row++){
        tdButton    = tr[row].getElementsByTagName('td')[3];
        if(tdButton){
            button  = tdButton.getElementsByClassName('fa-star')[0];
            button.classList.add('addFavorite');
        }
    }
}

function highlightStars(favArray){
    var table, tr, tdButton, row, button, linkNr, favString, buttonValue;
    if(favArray){
        table       = document.getElementsByTagName('table')[0];
        tr          = table.getElementsByTagName('tr');
        for(row = 0; row < tr.length; row++){
            tdButton    = tr[row].getElementsByTagName('td')[3];
            if(tdButton){
                button      = tdButton.getElementsByTagName('button')[0];
                buttonValue = button.value;
                for(linkNr = 0; linkNr < favArray.length; linkNr++){
                    favString   = Object.values(favArray[linkNr]);
                    // alert(buttonValue == favString);
                    if(favString == buttonValue){
                        button.classList.add('addFavorite');
                        break;
                    }
                }
            }
        }
    }
}
// var xhr = new XMLHttpRequest();
//
// xhr.open('POST', 'http://localhost/Aufgaben/LinksV2/index.php');
// xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
// xhr.onload = function() {
//     if (xhr.status === 200) {
//         alert('Something went wrong.  Name is now ' );
//     }
//     else if (xhr.status !== 200) {
//         alert('Request failed.  Returned status of ' + xhr.status);
//     }
// };
// xhr.send(encodeURI('name=Pee' ));

function getNonFavorites() {
    var linkName, row, favArray, hide, jsonArray;
    favArray	= new Array();
    linkName    = document.querySelectorAll(':not(.addFavorite).fa-star');
    hide		= document.getElementById('deleteFav');
    for(row = 0; row < linkName.length; row++){
        favArray.push(linkName[row].value);
    }
    jsonArray	= JSON.stringify(favArray);
    hide.value	= jsonArray;
}

function getFavorites() {
    var linkName, row, favArray, hide, jsonArray, imgWarning;
	favArray	= new Array();
	linkName    = document.getElementsByClassName('addFavorite');
	hide		= document.getElementById('newFav');
	if(linkName.length === 41){
	    imgWarning = document.createElement("IMG");
	    imgWarning.src = "../img/apyr.jpg";

    }
	for(row = 0; row < linkName.length; row++){
		favArray.push(linkName[row].value);
	}
	jsonArray	= JSON.stringify(favArray);
	hide.value	= jsonArray;
}

function plsLogin(){
    alert("Bitte melden Sie sich an, falls Sie Links speichern wollen!");
}

function resetForm(){
    var input, differentFilter, filter;
    differentFilter = document.getElementById('filteredCategory');
    if(differentFilter){
        filter = differentFilter.innerText;
    }
    input = document.getElementById('filterInput');
    input.value = '';
    if(filter){
        filterCategory(filter);
    }
    else{
        filterString("");
    }

}

function openCanvas() {
    var bars, userMenu;
    userMenu    = document.getElementById("userCanvas");
    bars        = document.getElementById("userBars");
    userMenu.style.width = "250px";
    bars.classList.add('hide');
    document.getElementsByClassName("content")[0].style.marginLeft = "250px";
}

function closeCanvas() {
    var bars, userMenu;
    userMenu    = document.getElementById("userCanvas");
    bars        = document.getElementById("userBars");
    userMenu.style.width = "0";
    bars.classList.remove('hide');
    document.getElementsByClassName("content")[0].style.marginLeft= "0";
}