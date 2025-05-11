import Axios from 'axios';

const API_URL = 'http://localhost:8000/api/Test';


export default {
    async getAllTests() {
        try {
            const response = await Axios.get(`${API_URL}/getAll`);
            return response.data;
        } catch (err) {
            console.error(err);
            throw err;
        }
    },

    async getTestById(id) {
        try {
            const response = await Axios.get(`${API_URL}/get/${id}`);
            return response.data;
        } catch (err) {
            console.error(err);
            throw err;
        }
    },

    async getTestUtilisable() {
        try {
            const response = await Axios.get(`${API_URL}/getTestUtilisable`);
            return response.data;
        } catch (err) {
            console.error(err);
            throw err;
        }
    },
    async getTestsWithQuestionsCount() {
        try {
            // First get all tests
            const response = await Axios.get(`${API_URL}/getAll`);
            const tests = response.data;

            // For each test, get the question count using the questions endpoint
            const testsWithCounts = await Promise.all(tests.map(async (test) => {
                try {
                    // Use the existing endpoint for questions
                    const questionsResponse = await Axios.post('http://localhost:8000/api/Question/getQuestionsTest', {
                        id: test.id
                    });

                    return {
                        ...test,
                        // Format test data for consistent access
                        title: test.nomTest || test.title || '',
                        type_test: test.typeTest || test.type_test || '',
                        utilisable: test.utilisable === 1 || test.utilisable === true,
                        // Add the questions count
                        testQuestionsCount: questionsResponse.data.length,
                        // Format date
                        lastUpdated: new Date(test.updated_at || test.createdAt || Date.now()).toLocaleDateString('ar-SA')
                    };
                } catch (err) {
                    console.warn(`Could not fetch questions for test ${test.id}:`, err);
                    // Return test with default count
                    return {
                        ...test,
                        title: test.nomTest || test.title || '',
                        type_test: test.typeTest || test.type_test || '',
                        utilisable: test.utilisable === 1 || test.utilisable === true,
                        testQuestionsCount: 0,
                        lastUpdated: new Date(test.updated_at || test.createdAt || Date.now()).toLocaleDateString('ar-SA')
                    };
                }
            }));

            return testsWithCounts;
        } catch (err) {
            console.error('Error fetching tests with question count:', err);
            throw err;
        }
    },
    async createTest(test) {
        try {
            const response = await Axios.post(`${API_URL}/create`, test);
            return response.data;
        } catch (err) {
            console.error(err);
            throw err;
        }
    },

    async updateTest(id, test) {
        try {
            console.log(`Sending PUT request to ${API_URL}/update/${id} with data:`, test);
            const response = await Axios.put(`${API_URL}/update/${id}`, test);
            console.log("Update response:", response.data);
            return response.data;
        } catch (err) {
            console.error("Error in updateTest:", err);
            console.error("Error response:", err.response?.data);
            throw err;
        }
    },

    async deleteTest(id) {
        try {
            const response = await Axios.delete(`${API_URL}/delete/${id}`);
            return response.data;
        } catch (err) {
            console.error(err);
            throw err;
        }
    },

    async deleteAllTests() {
        try {
            const response = await Axios.delete(`${API_URL}/deleteAll`);
            return response.data;
        } catch (err) {
            console.error(err);
            throw err;
        }
    },

    async getTestsByType(type) {
        try {
            const allTests = await this.getAllTests();
            return allTests.filter(test => test.typeTest === type || test.type_test === type);
        } catch (err) {
            console.error(err);
            throw err;
        }
    }
}