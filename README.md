# 🎵 MelodIQ - Music Trivia Game 🎵

MelodIQ is an interactive **music trivia game** where players test their music knowledge, earn points, and compete on leaderboards. Built using **CodeIgniter 4, Bootstrap, JavaScript, and AJAX**, this game provides a fun and engaging solo experience with trivia challenges created by admins.

---

## 🚀 Features

### 🎮 **For Players:**
- 🎵 Play music trivia games with **multiple-choice** questions
- 🏆 Earn points based on correct answers
- ⏳ Timer-based trivia for an extra challenge
- 📊 Track stats: **trivias played, total score, accuracy, and time spent**
- 🎭 User **profile with avatar and achievements**
- 🏅 **Leaderboard** to compete with other players

### 🛠 **For Admins:**
- ✏️ **Create, edit, delete** trivia quizzes
- 🎶 **Attach audio clips** to trivia questions
- 📊 Track **trivia stats and player performances**
- 🔗 Share trivia games via unique links

### 🔥 **Additional Features:**
- 🎨 Fully responsive UI (Bootstrap)
- 🌇 Dark/Light mode
- 📢 Social media sharing
- 🎿 Optional background music & sound effects

---

## 🏗️ Tech Stack

| **Technology**  | **Usage** |
|----------------|------------------|
| **CodeIgniter 4** | PHP Framework (Backend) |
| **Bootstrap** | Responsive UI & Styling |
| **JavaScript & AJAX** | Dynamic Trivia Gameplay |
| **MySQL** | Database for Users & Trivia |
| **jQuery** | Interactive UI Elements |
| **FontAwesome** | Icons & UI Enhancements |

---

## ⚙️ Installation & Setup

### 1️⃣ Clone the Repository
```sh
git clone https://github.com/jaydenklomp/melodiq.git
cd melodiq
```

### 2️⃣ Install Dependencies
Make sure you have **Composer** installed. Then run:
```sh
composer install
```

### 3️⃣ Database Setup
- Create a **MySQL database**
- Import the SQL file (provided in `/database/melodiq.sql`)
- Configure `.env` file with your database credentials:
```ini
database.default.hostname = localhost
database.default.database = melodiq
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

### 4️⃣ Run the Application
```sh
php spark serve
```
- Open in browser: **http://localhost:8080**

---

## 📌 How to Contribute
1. **Fork** the repo
2. **Create a new branch** (`feature-new-trivia`)
3. **Commit changes** (`git commit -m "Added leaderboard"`)
4. **Push** the branch (`git push origin feature-new-trivia`)
5. **Create a Pull Request**

---

## 📝 License
This project is licensed under the **MIT License**.

---

## 🌟 Support & Contact
For any issues, open an [issue on GitHub](https://github.com/JaydenKlomp/melodiq/issues).  
Enjoy playing **MelodIQ**! 🎶✨  
