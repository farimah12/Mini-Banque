# 🏦 Mini Banque

Mini-logiciel bancaire développé en PHP, permettant de gérer les utilisateurs, les clients, les comptes et les transactions (dépôts / retraits) d'une agence bancaire fictive.

Projet académique réalisé par **Adji Farimata Cissé**, étudiante en Génie Logiciel à l'Institut Supérieur d'Informatique (ISI), Dakar.

---

## ✨ Fonctionnalités

- 🔐 Authentification (connexion / déconnexion)
- 👥 Gestion des utilisateurs (ajout, modification, suppression)
- 🧑‍💼 Gestion des clients (ajout, modification, suppression)
- 💳 Gestion des comptes bancaires liés à un client
- 💰 Transactions : dépôt et retrait avec mise à jour automatique du solde
- 📊 Tableau de bord avec statistiques (nombre d'utilisateurs, de clients, de comptes)

## 🛠️ Technologies utilisées

- **PHP** (PDO pour l'accès à la base de données)
- **MySQL / MariaDB**
- **Bootstrap 5** + **Bootstrap Icons**
- **HTML / CSS / JavaScript**

## 📂 Structure du projet

```
BANQUE/
├── index.php               # Routeur principal (?page=...)
├── db.php                  # Connexion à la base de données
├── Connexion.php            # Page de connexion
├── ControlConnexion.php     # Traitement de la connexion / déconnexion
├── navbar.php / footer.php  # Composants communs
├── TabDeBord.php            # Tableau de bord
├── user.php + Ajout/Modif/SuppUser.php       # Gestion des utilisateurs
├── Clients.php + Ajout/Modif/SuppClient.php  # Gestion des clients
├── comptes.php + Ajout/Modif/SuppCompte.php  # Gestion des comptes
├── TransactionCompte.php    # Dépôts / retraits
├── style.css / script.js    # Design et interactions
└── gestion_banque.sql       # Script de création de la base de données
```

## 🚀 Installation locale (XAMPP)

1. Clone ce dépôt dans le dossier `htdocs` de XAMPP :
```bash
git clone https://github.com/farimah12/Mini-Banque.git
```
2. Démarre **Apache** et **MySQL** depuis le panneau de contrôle XAMPP.
3. Importe la base de données :
   - Ouvre **phpMyAdmin**
   - Crée une base nommée `gestion_banque` (ou laisse le script la créer automatiquement)
   - Onglet **Importer** → sélectionne `gestion_banque.sql`
4. Accède à l'application : `http://localhost/Mini-Banque/index.php?page=connexion`

## 🔑 Identifiants de démonstration

| Login | Mot de passe |
|-------|---------------|
| `admin` | `admin123` |

> ⚠️ Projet académique — base de données locale et identifiants de démonstration uniquement, à ne jamais réutiliser en production.


## 👩‍💻 Auteure

**Adji Farimata CISSE**
Étudiante en Génie Logiciel — ISI, Dakar
📧 adjifarimahcisse@gmail.com
