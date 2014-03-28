
/*
 * In these functions : a and b are Tags
 */
function sortById(a, b) {
    return (a.id - b.id);
}

function sortByTitle(a, b) {
    return a.title.localeCompare(b.title);
}

function sortByObservation(a, b) {
    return a.observation.localeCompare(b.observation);
}

function Tag(id, title, observation, element) {
    this.id          = id;
    this.title       = title;
    this.observation = observation;
    this.element     = element;
}

window.onload = function()
{
    var byIdButton          = document.querySelector('input[name="by_id"]');
    var byTitleButton       = document.querySelector('input[name="by_title"]');
    var byObservationButton = document.querySelector('input[name="by_observation"]');
    
    var selectedButton = document.querySelector('input[disabled="true"]');
    
    function swapButtons(newSelectedButton) {
        if (newSelectedButton === selectedButton)
            return;
        
        selectedButton.disabled = false;
        selectedButton = newSelectedButton;
        selectedButton.disabled = true;
    }
    
    var allTags   = document.querySelector('section#TagMenuView table.tags').firstChild;
    var arrayTags = new Array();
    
    if (allTags !== null)
        for(var i = 0; i < allTags.childElementCount; ++i)
        {            
            id           = parseInt(allTags.childNodes[i].cells[0].innerHTML);
            title        = allTags.childNodes[i].cells[1].innerHTML;
            observation  = allTags.childNodes[i].cells[4].innerHTML;
            element      = allTags.childNodes[i];
            arrayTags[i] = new Tag(id, title, observation, element);
        }
    
    function sortBy(selectedButton) {
        var sortFunction = null;
        
        if (selectedButton === byIdButton)
            sortFunction = sortById;
        else if (selectedButton === byTitleButton)
            sortFunction = sortByTitle;
        else
            sortFunction = sortByObservation;
        
        if (allTags === null || arrayTags.length < 2 || sortFunction === null)
            return;
        
        arrayTags.sort(sortFunction);
        
        allTags.innerHTML = "";
        
        for(var i = 0; i < arrayTags.length; ++i)
            allTags.appendChild(arrayTags[i].element);
    }
    
    byIdButton.addEventListener('click', function(event) {
        swapButtons(this);
        sortBy(this);
    }, false);
    
    byTitleButton.addEventListener('click', function(event) {
        swapButtons(this);
        sortBy(this);
    }, false);
    
    byObservationButton.addEventListener('click', function(event) {
        swapButtons(this);
        sortBy(this);
    }, false);
}