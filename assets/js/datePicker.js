/*
* file: datePicker.js
* This javascript/ajax will get the earliest and latest date of a job instance on page load.
* This will serve as the upper and lower bounds of the query that will get all of the jobs in between that date.
*/
$('document').ready (function ()
{
    // start ajax call
    $.ajax({
        // define URL
        url: window.location.origin+"/CMSC198/get_date",
        // define data type of return variable
        dataType: 'json',
        // on successful return of said variable
        success: function (array)
        {
            // if the array is set
            if (array)
            {
                // evaluate the object
                arrayNew = eval (array);
                // get the variables
                var min = arrayNew['minDate'];
                var max = arrayNew['maxDate'];
            }

            // set attributes for date 1 picker
            $('#date1').pickadate ({
                // shows what format to display once a date is picked
                format: 'yyyy/mm/dd',

                // show the format of the date once it is submitted in a form
                formatSubmit: 'yyyymmdd',

                // sets the first day of the week. any false value for Sunday. any true value for Monday
                firstDay: false,

                // sets the bounds of the date picker
                min: new Date (String(min)), // lower bound
                max: new Date (String (max)), // upper bound

                // from pickadate.js docs: strips the name of the source and sets it as the name of the input
                hiddenName: true
            });

            $('#date2').pickadate ({
                format: 'yyyy/mm/dd',
                formatSubmit: 'yyyymmdd',
                firstDay: false,
                min: new Date (String(min)),
                max: new Date (String(max)),
                hiddenName: true
            });
        }
    });
});
// end of datePicker.js
