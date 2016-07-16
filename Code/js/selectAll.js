function selectAll()
{
    selectBox = document.getElementById("game");

    for (var i = 0; i < selectBox.options.length; i++)
    {
        selectBox.options[i].selected = true;
    }
}