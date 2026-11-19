# Online Marriage Registration System (OMRS) - Render & Aiven Cloud Ready

A complete, modern PHP & MySQL web application for managing online marriage registrations, fully upgraded for **PHP 8.2+**, **Aiven Cloud MySQL (SSL)**, and **Render Cloud Web Service (Docker)**.

---

## 🔐 Quick Credentials & Login Details (ID & Password)

### 👑 1. Admin Login Credentials
| Field | Value / Details |
| :--- | :--- |
| **Admin Login URL** | [https://marriage-registration-system-demo.onrender.com/admin/login.php](https://marriage-registration-system-demo.onrender.com/admin/login.php) |
| **Username** | `admin` |
| **Password** | `admin123` |
| **Role** | System Administrator (Full Access) |
| **Features** | 1-Click "Fill Form" button & Eye Toggle on login screen |

---

### 👫 2. Client / User Login Credentials
| Account | Email / Identifier | Password | Access URL |
| :--- | :--- | :--- | :--- |
| **Demo Client 1** | `slou@sample.com` | `slou123` *(or `admin123`)* | [Open Client Portal](https://marriage-registration-system-demo.onrender.com/login.php) |
| **Demo Client 2** | `mwilliams@sample.com` | `mwilliams` *(or `admin123`)* | [Open Client Portal](https://marriage-registration-system-demo.onrender.com/login.php) |
| **Admin Quick Bypass**| `admin` | `admin123` | [Open Client Portal](https://marriage-registration-system-demo.onrender.com/login.php) *(Auto-redirects to Admin)* |

> [!TIP]
> **Universal Auto-Fill**: Dono login screens par **"Fill Form"** button diya gaya hai. Us par click karte hi ID aur Password automatically fill ho jayenge!

---

### ☁️ 3. Aiven Cloud MySQL Database Credentials
| Configuration Key | Value | Description |
| :--- | :--- | :--- |
| `DB_SERVER` *(or `DB_HOST`)* | `mysql-1a85412b-maheshchouhanmsk12-c513.a.aivencloud.com` | Aiven Cloud MySQL Host |
| `DB_PORT` | `26284` | Aiven 5-digit custom port |
| `DB_USERNAME` *(or `DB_USER`)* | `avnadmin` | Default Admin User |
| `DB_PASSWORD` *(or `DB_PASS`)* | `[Your Aiven Service Password]` | Aiven Service Password from Console |
| `DB_NAME` | `defaultdb` *(or `omrs_db`)* | Database Name |
| `DB_SSL` | `true` | Required for Aiven SSL (`MYSQLI_CLIENT_SSL`) |
| `PORT` | `10000` | Render internal container port |

---

## 🚀 Live Application Endpoints & Repository

| Resource | URL / Location |
| :--- | :--- |
| **GitHub Repository** | [https://github.com/1234Adityarajput/Marriage-Registration-System-Demo](https://github.com/1234Adityarajput/Marriage-Registration-System-Demo) |
| **Live App Website (Render)** | `https://marriage-registration-system-demo.onrender.com/` *(or your Render Web Service URL)* |
| **Admin Login Portal** | `https://marriage-registration-system-demo.onrender.com/admin/login.php` |
| **Client / Couple Portal** | `https://marriage-registration-system-demo.onrender.com/login.php` |
| **New Couple Registration** | `https://marriage-registration-system-demo.onrender.com/registration.php` |
| **1-Click DB Setup & Health** | `https://marriage-registration-system-demo.onrender.com/db_setup.php` |

---

## 🛠️ Key Architectural Enhancements & Fixes

1. **Aiven Cloud SSL & 5-Digit Port Support**:
   - Upgraded `classes/DBConnection.php` using `mysqli_init()`, `$conn->ssl_set()`, and `MYSQLI_CLIENT_SSL` flags (`require_secure_transport=ON`).
   - Supports 5-digit ports (e.g. `26284`) and environment variable fallbacks.
   - Built-in static connection pooling to avoid redundant remote TCP handshakes.

2. **PHP 8.2 Compatibility**:
   - Safe constructor initialization for all class properties.
   - Safe `mysqli_result` and `num_rows` null-checks to prevent fatal crashes if tables are empty.
   - Fixed SQL syntax issues (`DELETE FROM` instead of `DELETE * FROM`).

3. **Render Reverse-Proxy & Port 10000 Leak Prevention**:
   - Custom `Dockerfile` based on `php:8.2-apache` with `mysqli`, `pdo_mysql`, `gd`, `zip`, and Apache `mod_rewrite` + `headers`.
   - Custom `start.sh` dynamically binds to `$PORT` and configures `UseCanonicalName Off`, `UseCanonicalPhysicalPort Off`, and `ServerName localhost`.
   - Direct file routing to `admin/index.php` and `admin/login.php` preventing `mod_dir` trailing slash port leakage.
   - Smart `.htaccess` port-stripping rules.

4. **1-Click Database Setup & Importer (`db_setup.php`)**:
   - Visual web installer to test Aiven SSL connectivity and server health.
   - Clean SQL dump parser (`SET FOREIGN_KEY_CHECKS = 0`) to import `database/omrs_db.sql` with 1 click.
   - Automatically verifies database tables and default admin credentials with direct login shortcuts.

5. **Database Auto-Healer**:
   - `DBConnection.php` automatically provisions missing tables (`users`, `clients`, `registration_list`, `registration_details`, `system_info`) and guarantees default credentials if the database is initially empty.

---

## 📋 Step-by-Step Render Deployment Guide

1. **Push Code to GitHub**:
   - Code is already committed and pushed to your repo: `https://github.com/1234Adityarajput/Marriage-Registration-System-Demo`.

2. **Create New Web Service on Render**:
   - Log in to [Render Dashboard](https://dashboard.render.com/).
   - Click **New +** > **Web Service**.
   - Select **Build and deploy from a Git repository**.
   - Connect or paste your repository: `https://github.com/1234Adityarajput/Marriage-Registration-System-Demo`.

3. **Configure Service Settings**:
   - **Name**: `marriage-registration-system-demo`
   - **Region**: Oregon (or nearest)
   - **Runtime**: `Docker`
   - **Instance Type**: `Free`

4. **Set Environment Variables**:
   In the **Environment** section, add:
   - `DB_SERVER` = `mysql-1a85412b-maheshchouhanmsk12-c513.a.aivencloud.com`
   - `DB_PORT` = `26284`
   - `DB_USERNAME` = `avnadmin`
   - `DB_PASSWORD` = `[Your Aiven Password]`
   - `DB_NAME` = `defaultdb` *(or `omrs_db`)*
   - `DB_SSL` = `true`

5. **Deploy & Setup Database**:
   - Click **Create Web Service**.
   - Wait 1-2 minutes for Docker build and startup.
   - Open your live app URL: `https://marriage-registration-system-demo.onrender.com/db_setup.php` to verify SSL health and import default tables with 1 click!

---

## 🐳 Local Testing with Docker

```bash
# Build the Docker container image
docker build -t marriage-registration-system .

# Run container locally on port 10000
docker run -p 10000:10000 \
  -e DB_SERVER="mysql-1a85412b-maheshchouhanmsk12-c513.a.aivencloud.com" \
  -e DB_PORT="26284" \
  -e DB_USERNAME="avnadmin" \
  -e DB_PASSWORD="your_password" \
  -e DB_NAME="defaultdb" \
  -e DB_SSL="true" \
  marriage-registration-system
```
Open [http://localhost:10000](http://localhost:10000) in your browser.

---

## 📁 Safe File Backups (.original)

As per system ground rules, all original files have been safely backed up with `.original` extension:
- `initialize.php.original`
- `config.php.original`
- `classes/DBConnection.php.original`
- `classes/SystemSettings.php.original`
- `classes/Login.php.original`
- `classes/Master.php.original`
- `classes/Users.php.original`
- `dist/js/script.js.original`
- `.htaccess.original`
- `admin/.htaccess.original`
- `admin/inc/sess_auth.php.original`
- `inc/sess_auth.php.original`
- `admin/login.php.original`
- `login.php.original`
- `registration.php.original`
- `start.sh.original`
- `Dockerfile.original`
- `render.yaml.original`
- `README.md.original`
