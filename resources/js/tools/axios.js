// resources/js/axios.js

import axios from 'axios';

const instance = axios.create({
    baseURL: process.env.MIX_API_URL ,
    // You can set other default configurations here
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
});

export default instance;