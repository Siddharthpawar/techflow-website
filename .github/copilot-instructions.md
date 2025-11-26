<!-- copilot-instructions.md - guidance for AI coding agents working on this repo -->
# TechFlow Website — Copilot Instructions

Purpose: provide concise, actionable knowledge so an AI coding agent can be immediately productive editing this simple PHP website.

- Quick facts
  - Language: plain PHP (no framework), HTML, inline CSS.
  - No build tools or package managers discovered (no composer.json, package.json, etc.).
  - Persistent data is file-based: `contact_info.txt` and `contact_submissions.txt` in the repository root.
  - There is an SSH key file present (`SiddharthEC2.pem`) — treat as sensitive and do not expose credentials.

- Quick start (local dev)
  - Run a local PHP server from the repository root and open a browser:
    - php -S 0.0.0.0:8000 -t .
  - Visit http://localhost:8000/index.php (or simply http://localhost:8000)
  - To test contact handling, open `contacts.php` and submit the form; submissions are appended to `contact_submissions.txt`.

- High-level architecture and patterns (what to know)
  - This is a multi-page PHP site. Each page (index.php, about.php, products.php, news.php, contacts.php, graphic.php) contains its own HTML, inline CSS, and duplicated navigation markup.
  - There is no centralized templating or routing: pages are directly accessed by filename (e.g., `index.php`).
  - Data persistence is simple file I/O:
    - `contacts.php` reads/writes `contact_info.txt` (creates a default if missing).
    - Form submissions are written to `contact_submissions.txt` using `file_put_contents(..., FILE_APPEND)`.
  - Inputs are minimally sanitized using `htmlspecialchars()` before echoing; follow this pattern when adding output.

- Project-specific development notes and conventions
  - Inline styles: CSS is embedded in each PHP file. When modifying layout, update every page containing the navigation/header/footer or consider extracting a shared include if making large changes.
  - Contact file format: `contact_info.txt` is plain text with blank lines used to separate sections; `contacts.php` heuristically treats lines containing "Office" or "Team" as section headers.
  - File permissions matter: writing submissions/contact_info requires the PHP process to have write permissions to the repository root (or the files). When debugging missing writes, check permissions.
  - Minimal security: there is no CSRF protection and no server-side validation beyond basic sanitization. Avoid adding remote-sensitive logic without adding proper validation and secure storage.

- Integration & deployment hints (observable)
  - No cloud infra code in the repo, but the presence of `SiddharthEC2.pem` implies deployment to an EC2 instance. Do NOT expose private keys in PRs.
  - To deploy manually: sync files to an Apache/nginx + PHP host (or copy to EC2). Ensure `contact_submissions.txt` is writable by the webserver user.

- Editing examples (where to change things)
  - To change navigation links: edit `index.php` and mirror changes into `about.php`, `products.php`, `news.php`, `contacts.php`, `graphic.php` (navigation is duplicated across pages).
  - To change default contact data: edit the default string in `contacts.php` where `$defaultContacts` is constructed and written to `contact_info.txt`.
  - To change form handling: modify the POST handling block at the bottom of `contacts.php` (inputs are sanitized with `htmlspecialchars()` and appended to `contact_submissions.txt`).

- Common gotchas to surface to a human reviewer
  - Missing write permission will make contact default-creation or submission-saving fail silently—check file existence and permissions.
  - The repository currently stores a private key file. If you plan to commit changes, consider rotating/removing keys and adding them to `.gitignore`.

- What not to do (rules for an AI agent)
  - Do not commit or print the contents of `SiddharthEC2.pem` or other private files. If exploring, flag the file path and ask the user about secrets handling.
  - Don’t assume a database is available — use the repository's file-based patterns unless the user asks to migrate to a DB.

- If anything above is unclear or you want additional detail (for example, a suggested refactor to centralize the header/footer into a shared include), tell me what to expand or change and I will iterate.
