import axios from 'axios';

// Define the base URL for API calls
const API_URL = 'http://localhost:9090/api';

export default {
  getSousChaptersByChapterId(chapterId) {
    return axios.get("SousChapitres/getByChapitreId/"+chapterId)
      .then(response => response.data) // تأكد من بنية البيانات
      .catch(error => {
        console.error('Error fetching sub-chapters:', error);
        throw error;
      });
  },

  /**
   * Create a new sub-chapter
   * @param {Object} sousChapter - The sub-chapter data
   * @returns {Promise} Promise object representing the created sub-chapter
   */
  createSousChapter(sousChapter) {
    return axios.post(`${API_URL}/SousChapitres/createSousChapitre`, sousChapter)
      .then(response => response.data)
      .catch(error => {
        console.error('Error creating sub-chapter:', error);
        throw error;
      });
  },

  /**
   * Update an existing sub-chapter
   * @param {Number} id - The ID of the sub-chapter to update
   * @param {Object} sousChapter - The updated sub-chapter data
   * @returns {Promise} Promise object representing the updated sub-chapter
   */
  updateSousChapter(id, sousChapter) {
    return axios.put(`${API_URL}/SousChapitres/updateSousChapitre/${id}`, sousChapter)
      .then(response => response.data)
      .catch(error => {
        console.error('Error updating sub-chapter:', error);
        throw error;
      });
  },

  /**
   * Delete a sub-chapter
   * @param {Number} id - The ID of the sub-chapter to delete
   * @returns {Promise} Promise indicating deletion success
   */
  deleteSousChapter(id) {
    return axios.delete(`${API_URL}/SousChapitres/delete/${id}`)
      .then(response => response.data)
      .catch(error => {
        console.error('Error deleting sub-chapter:', error);
        throw error;
      });
  },

  /**
   * Set the last read page for a sub-chapter
   * @param {Number} id - The ID of the sub-chapter
   * @param {Object} sousChapter - The sub-chapter with lastPageRead property
   * @returns {Promise} Promise object representing the updated sub-chapter
   */
  // setLastReadPage( sousChapter) {
  //   return axios.put(`${API_URL}/SousChapitres/setLastPageRead`, sousChapter)
  //     .then(response => response.data)
  //     .catch(error => {
  //       console.error('Error setting last read page:', error);
  //       throw error;
  //     }); 
  // },
  async setLastReadPage(sousChapter) {
    try {
        const response = await axios.put('UserSousChapitreProgress/setLastPageRead', sousChapter);
        return response.data;
    } catch (err) {
        console.error(err);
        throw err;
    }
},
  
  /**
   * Get the last read page for a sub-chapter
   * @param {Number} id - The ID of the sub-chapter
   * @returns {Promise} Promise object representing the sub-chapter with last read page
   */
  // getLastReadPage(id) {
  //   return axios.get(`${API_URL}/SousChapitres/getLastReadPage/${id}`)
  //     .then(response => response.data)
  //     .catch(error => {
  //       console.error('Error getting last read page:', error);
  //       throw error;
  //     });
  // }
  async getLastReadPage(data) {
    try {
        const response = await axios.post('UserSousChapitreProgress/getLastReadPage',data);
        return response.data;
    } catch (err) {
        console.error(err);
        throw err;
    }
  },
  async getAllUserSouschapitreProgress(userId,data){
    try{
      const res = await axios.post("UserSousChapitreProgress/get/"+userId,data);
      return res.data;
    }catch(err){
      console.error(err);
      throw err;
    }
 
  },
};