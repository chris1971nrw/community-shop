-- Community Shop SQLite Datenbankstruktur
-- Erstellt mit SQLite, PHP-kompatibel

-- Haupttabellen erstellen
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    email TEXT UNIQUE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT,
    amazon_url TEXT NOT NULL,
    price TEXT,
    image_url TEXT,
    submitted_by INTEGER,
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    approved INTEGER DEFAULT 0,
    status TEXT DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (submitted_by) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS votes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    vote_value INTEGER CHECK (vote_value IN (1, -1)),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    UNIQUE(user_id, product_id)
);

CREATE TABLE IF NOT EXISTS weekly_votes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    week_start DATE NOT NULL,
    status TEXT DEFAULT 'open',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    ended_at DATETIME,
    UNIQUE(week_start)
);

CREATE TABLE IF NOT EXISTS weekly_results (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    week_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    vote_count INTEGER DEFAULT 0,
    rank INTEGER DEFAULT 0,
    FOREIGN KEY (week_id) REFERENCES weekly_votes(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE INDEX IF NOT EXISTS idx_products_status ON products(status);
CREATE INDEX IF NOT EXISTS idx_votes_product ON votes(product_id);
CREATE INDEX IF NOT EXISTS idx_votes_user ON votes(user_id);
CREATE INDEX IF NOT EXISTS idx_weekly_week ON weekly_votes(week_start);

-- Initiale Daten einfügen (optional)
INSERT OR IGNORE INTO users (username, email) VALUES ('admin', 'admin@communityshop.local');
