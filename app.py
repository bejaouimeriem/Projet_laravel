from flask import Flask, request, jsonify
import google.generativeai as genai
from flask_cors import CORS  # Pour autoriser les requêtes cross-origin

# Configure la clé API pour Google Gemini
genai.configure(api_key="AIzaSyCWIoKMGRhJW1veIwvgIIWtEHfMIrThwLs")  # Remplace par ta clé API

# Crée une instance de l'application Flask
app = Flask(__name__)
CORS(app)  # Autorise toutes les origines à accéder à l'API Flask

# Fonction pour interagir avec l'API Gemini
def chat_with_gemini(prompt):
    model = genai.GenerativeModel(model_name="gemini-1.5-flash-latest")  # Choix du modèle
    response = model.generate_content(f"Réponds de manière concise et claire : {prompt}")
    return response.text.strip()  # Retourne le texte généré et Supprime les espaces inutiles

@app.route('/chat', methods=['POST'])
def chat():
    # Récupère le message envoyé par l'utilisateur depuis la requête
    user_message = request.json.get('message')
    if not user_message:
        return jsonify({'error': 'No message provided'}), 400

    # Appel à l'API Gemini pour obtenir une réponse
    try:
        bot_response = chat_with_gemini(user_message)
        return jsonify({'response': bot_response})  # Envoie la réponse du bot
    except Exception as e:
        return jsonify({'error': str(e)}), 500  # Gestion des erreurs

if __name__ == "__main__":
    app.run(debug=True)  # Démarre le serveur Flask
