import axios from 'axios';

class HTTP
{

    /**
     * Send HTTP GET request
     * @param {string} url URL
     * @param {object} data
     * @param {function(number, ({}|string))} callback
     * @type {{key:string}} data
     * @returns {function}
     */
    get(url, data, callback = function(satus,data){})
    {
        return axios.get(url, {
            params: data
        })
            .then(function(response) {
                callback(response.status, response.data);
            })
            .catch(function(error) {
                if (error.response) {
                    callback(error.response.status, error.response.data);
                } else {
                    console.log(error);
                }
            })
        ;
    }

    /**
     * Send HTTP POST request
     * @param {string} action URL
     * @param {object} data
     * @param {function(number, ({success,message,html,text,balance,points}|string))} callback
     * @type {{key:string}} data
     * @returns {function}
     */
    post(action, data, callback = function(satus,data){})
    {
        let form_data = data;

        if (false === data instanceof FormData) {
            form_data = new FormData();

            for(let key in data) {
                form_data.set(key, data[key]);
            }
        }

        return axios.post(action, form_data)
            .then(function(response) {
                callback(response.status, response.data);
            })
            .catch(function(error) {
                if (error.response) {
                    callback(error.response.status, error.response.data);
                } else {
                    console.log(error);
                }
            })
        ;
    }

}

export default new HTTP();
