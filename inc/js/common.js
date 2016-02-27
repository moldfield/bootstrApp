/*global define*/
'use strict';

define([], function () {

	isChecked: function (id) {
		if ( $('#'+id+':checked').length > 0) {
			return true;
		} else {
			return false;
		}
	}

	getWPData: function (url) {
    return new Promise( function (resolve,reject) {
      $.ajax({
        url: WP_API_Settings.root + 'wp/v2/'+ url,
        method: 'GET',
        beforeSend: function ( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', WP_API_Settings.nonce );
        },
        success: function (response) {
          console.log('WP data ', response );
          resolve(response);
        },
        err: function (err) {
          console.log(err);
          reject(err);
        }
      });
    });
  } // getWPData

  getData: function (action,theData) {
    return new Promise(function (resolve,reject) {
      var start = moment();
      $.ajax({
        type: 'POST',
        url: 'http://analytics.mckayadvertising.com/wp-admin/admin-ajax.php',
        data: {"action": action, data: theData },
          success: function(response) {
           // console.log("Adwords accounts: ", response);
            var end = moment();
            console.log(action+' finished '+ moment.duration(end.diff(start)).asMilliseconds() +' ms after request.');
            resolve(response);
          },
          error: function(err){
            console.log(err);
            reject();
          }
        });
    });  
  }

	return {
		isChecked: isChecked,
		ENTER_KEY: 13,
		ESCAPE_KEY: 27
	};
});