import axios from 'axios';

const CategoriesApiService = {
    fetchCategories() {
        return axios.get('/api/categories');
    },
};
export default CategoriesApiService;
