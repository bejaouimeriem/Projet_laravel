import Axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api/Tache';



export default {
  async getTachesByUserandDate(id, date) {
    try {
      const response = await Axios.post(`${API_URL}/get/${id}`, {date});
      console.log(response.data);
      return response.data;
    } catch (err) {
      console.error(err);
      throw err;
    }
  },

  async updateTache(id,done){
    try{
        const res = await Axios.put(`${API_URL}/put/${id}`,{
            id:id,
            done: Number(done)
        });
        return res.data;
    }
    catch(err){
      console.error(err);
      throw err;
    }
  },
  async addTache(nomTache, idUser,date) {
    try{
        const res = await Axios.post(`${API_URL}/create`,{
            nomTache:nomTache,
            userId:idUser,
            date:date,
            done:0
        });
        return res.data;
    }
    catch(err){
        console.error(err);
        throw err;
    }
  }
};
