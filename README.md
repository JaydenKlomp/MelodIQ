# 🎵 MelodIQ - Music Trivia Game

![PHP](https://img.shields.io/badge/PHP-8.1-blue) ![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.3-red) ![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)

Welcome to **MelodIQ**, a fun and engaging music trivia game! Test your music knowledge, compete with others, and climb the leaderboard. Whether you're a casual listener or a hardcore music fan, there's something for everyone!

---

## 📜 License
This project is licensed under the **GNU General Public License v2.0 (GPL-2.0)**. You are free to modify and distribute the project under the same license.

For more details, see the [LICENSE](LICENSE) file.

---

## 🚀 Features
- 🎮 **Play Trivia** - Choose from different categories and difficulties.
- 📝 **Create Trivia** - Admins can create and edit trivia quizzes.
- 📊 **Leaderboard** - Compete with other players and see the rankings.
- 📈 **Player Stats** - Track your total points, games played, and answer accuracy.
- 👥 **Followers System** - Follow and connect with other players.
- 🔊 **Media Questions** - Includes **audio & video** questions.

---

## 🛠️ Installation & Setup
### 1️⃣ Prerequisites
- PHP 8+
- MySQL/MariaDB
- Apache/Nginx
- Composer (for dependencies)

### 2️⃣ Clone the Repository
```sh
git clone https://github.com/YOUR_USERNAME/melodiq.git
cd melodiq
```

### 3️⃣ Install Dependencies
```sh
composer install
```

### 4️⃣ Configure the Environment
Rename `.env.example` to `.env` and update database credentials:
```sh
cp .env.example .env
```
Update the following lines in `.env`:
```
database.default.hostname = localhost
database.default.database = melodiq
database.default.username = root
database.default.password = yourpassword
database.default.DBDriver = MySQLi
```

### 5️⃣ Run Database Migrations
- Import `codeigniter.sql` into MySQL using PhpMyAdmin or CLI:
```bash
mysql -u root -p a3bc < codeigniter.sql
```

### 6️⃣ Start the Server
```sh
php spark serve
```

The project will be available at: [http://localhost:8080](http://localhost:8080)

---

## 🎮 How to Play
1. **Register/Login** - Create an account to track your progress.
2. **Choose a Trivia** - Browse available quizzes and select one.
3. **Answer Questions** - Choose the correct answers before time runs out.
4. **Earn Points** - Get points for correct answers.
5. **Check Leaderboard** - See where you rank among other players!

---

## 🎩 Admin Features
Admins have additional privileges:
- **Create Trivia** - Add new quizzes with multiple questions.
- **Edit Trivia** - Modify existing quizzes.
- **Delete Trivia** - Remove outdated quizzes.

To set a user as an admin, update the `is_admin` field in the database to `1`.

---

## 🌟 Contributing
We welcome contributions! Follow these steps:
1. 🍴 Fork the repository
2. 🌿 Create a new branch (`git checkout -b feature-name`)
3. 🛠️ Make your changes
4. 🚀 Commit and push (`git commit -m "Added new feature" && git push origin feature-name`)
5. 🔁 Open a Pull Request

---

## 🔧 Troubleshooting
- **Database connection issues?** Check your `.env` file settings.
- **Migrations not running?** Ensure your database exists and is correctly configured.
- **Can't log in?** Check the users table to ensure credentials are correct.

---

👨‍💻 **Developed by [Jayden Klomp](https://github.com/JaydenKlomp)**  
🔗 **GitHub Repository:** [MelodIQ](https://github.com/JaydenKlomp/melodiq)


Enjoy playing **MelodIQ**! 🎶🔥

