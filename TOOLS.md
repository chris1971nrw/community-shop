# Tools für den Community‑Supervisor Agent

## GitHub: Issue Management
tool: github.create_issue
description: Erstelle ein neues Issue im Repository.
params: title, body, labels

tool: github.update_issue
description: Aktualisiere ein bestehendes Issue.
params: issue_number, title, body, state, labels

tool: github.comment_issue
description: Kommentiere ein Issue.
params: issue_number, body

tool: github.close_issue
description: Schließe ein Issue.
params: issue_number

## GitHub: Pull Requests
tool: github.create_pull_request
description: Erstelle einen neuen Pull Request.
params: title, body, head, base

tool: github.merge_pull_request
description: Merge einen PR.
params: pull_number, merge_method

tool: github.comment_pull_request
description: Kommentiere einen PR.
params: pull_number, body

## GitHub: Repository Files
tool: github.get_file
description: Hole eine Datei aus dem Repo.
params: path

tool: github.update_file
description: Aktualisiere eine Datei im Repo.
params: path, content, message

tool: github.create_file
description: Erstelle eine neue Datei.
params: path, content, message

## GitHub: Wiki
tool: github.update_wiki
description: Aktualisiere eine Wiki‑Seite.
params: page, content

## GitHub: Pages
tool: github.deploy_pages
description: Trigger ein GitHub Pages Deployment.
params: none

## GitHub: Actions
tool: github.trigger_workflow
description: Starte ein GitHub Actions Workflow.
params: workflow_file, ref

## GitHub: Releases
tool: github.create_release
description: Erstelle ein Release.
params: tag_name, name, body

## GitHub: Security
tool: github.get_dependabot_alerts
description: Hole Sicherheitswarnungen.
params: none

## Lokale Tools
tool: local.read_file
description: Lies eine lokale Datei.
params: path

tool: local.write_file
description: Schreibe eine lokale Datei.
params: path, content

tool: local.run
description: Führe einen lokalen Befehl aus.
params: command

tool: local.git_commit
description: Committe lokale Änderungen.
params: message

tool: local.git_push
description: Pushe Änderungen auf GitHub.
params: branch

tool: local.git_checkout
description: Wechsle oder erstelle einen Branch.
params: branch

## Memory Tools
tool: memory.read
description: Lies den Inhalt der Memory-Datei.
params: none

tool: memory.write
description: Schreibe oder erweitere Memory-Einträge.
params: content

tool: memory.replace
description: Ersetze einen bestehenden Memory-Eintrag.
params: old, new