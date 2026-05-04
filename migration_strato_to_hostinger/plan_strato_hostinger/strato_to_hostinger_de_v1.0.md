# Migrationsplan: Strato → Hostinger  

### Autor: Dr. Henry Macartney
### Datum: 01.05.2026

## Betroffene Domains

| Domain | Praxisinhaber | Status |
|---|---|---|
| `birgit-kretzschmar.de` | Birgit Kretzschmar (Tanz- und Lehrtherapeutin) | WordPress + Datenbank bereits zu Hostinger migriert, Staging unter `mediumspringgreen-ant-406352.hostingersite.com` |
| `kretzschmar-wiesbaden.de` | Dr. Alexander Kretzschmar (Psychologischer Psychotherapeut) | WordPress + Datenbank bereits zu Hostinger migriert, Staging unter `sienna-kudu-455515.hostingersite.com` |

Beide Staging-Sites wurden überprüft und sind funktionsfähig (Inhalte, Navigation und Bilder vollständig vorhanden).

## Kontext & Rahmenbedingungen

- Beide sind **professionelle psychotherapeutische Praxen** — patientennah, 
  DSGVO-relevant, Behörden-relevant, Ausfallzeiten sollten minimiert werden
- Strato-Kündigung wurde vor ca. 1 Monat eingereicht; **die AuthInfo-Codes für beide Domains nähern sich dem 30-Tage-Ablauf** (.de-Domains)
- Beide Auth-Codes liegen uns bereits vor
- WordPress- und Datenbankmigration ist **abgeschlossen** (dieser Teil ist erledigt)
- Pro Domain mussten ursprünglich drei Komponenten migriert werden:
  1. ✅ WordPress-Dateien + MySQL-Datenbank — **erledigt**
  2. ⏳ Domain-Registrierung (.de) — ausstehend, zeitkritisch
  3. ⏳ E-Mail-Postfächer — ausstehend, kritisch für die Praxen

## Was noch zu tun ist — drei Arbeitsbereiche

### 1. Übertragung der Domain-Registrierung (DRINGEND — Auth-Code-Frist läuft)

Vorgehen bei **Hostinger**:

1. Hostinger-Seite "Domain übertragen" öffnen
2. `birgit-kretzschmar.de` eingeben → bezahlen → AuthInfo-Code einfügen
3. Bei der Frage zu Nameservern **"Hostinger-Nameserver verwenden"** auswählen (sauberste Option, da die Sites bereits bei Hostinger liegen)
4. Vorgang für `kretzschmar-wiesbaden.de` wiederholen
5. Die Bestätigungs-E-Mail von Hostinger anklicken

Bei .de-Domains ist die Übertragung in der Regel innerhalb von 1–4 Tagen abgeschlossen.

**Falls ein Auth-Code abläuft, bevor wir handeln:** einen neuen im Strato-Kundenservicebereich anfordern (Login-Bereich → Domainverwaltung → Link "Authcode anfordern" neben der gekündigten Domain). Hinweis: Laut Strato-Dokumentation sind .de-Auth-Codes 30 Tage gültig und müssen danach erneut angefordert werden.

**Harte Frist:** das Strato-Kündigungsdatum selbst. Danach wird die Domain freigegeben und ist gefährdet. Das genaue "Vertragsende"-Datum aus der Strato-Kündigungsbestätigungs-E-Mail muss heute überprüft werden.

### 2. WordPress-Primärdomain-Wechsel bei Hostinger (nach Beginn der Übertragung)

Aktuell antwortet jede Site unter dem `*.hostingersite.com`-Staging-Hostnamen. Sobald die Hostinger-Nameserver für die echten .de-Domains übernehmen, muss jede WordPress-Installation auf die echte Domain umgestellt werden.

Im **hPanel**, für jede Site:

1. Zu den Einstellungen der Website wechseln → Primärdomain von `*.hostingersite.com` auf die echte `.de`-Domain ändern
2. Hostingers Suchen-und-Ersetzen-Tool ausführen (oder WP-CLI bzw. ein Plugin wie Better Search Replace verwenden), um **alle** Vorkommen der Staging-URL in der Datenbank durch die echte Domain zu ersetzen — betrifft `wp_options` (`siteurl`, `home`), Beitragsinhalte, Bild-URLs, Theme-Optionen, Plugin-Konfigurationen
3. Bestätigen, dass das SSL-Zertifikat für die .de-Domain automatisch ausgestellt wird (Let's Encrypt über Hostinger — meist innerhalb weniger Minuten nach DNS-Auflösung)
4. Gründlich testen: Navigation, Bildladevorgänge, Einsendungen über das Kontaktformular, Admin-Login

**Reihenfolge ist wichtig:** Den WordPress-Primärdomain-Wechsel erst nach erfolgter DNS-Propagation zu Hostinger durchführen, sonst ist die Site kurzzeitig nicht erreichbar.

### 3. E-Mail-Postfächer (der heikelste Teil — sorgfältige Planung erforderlich)

Patienten schreiben an diese Adressen, daher muss dieser Schritt mit besonderer Sorgfalt erfolgen.

**Schritt A — Bestandsaufnahme bei Strato**

Im Strato-E-Mail-Verwaltungsbereich anmelden und pro Domain auflisten:
- Alle Postfächer (z. B. `kontakt@…`, `praxis@…`, `info@…`)
- Alle Weiterleitungen und Aliase
- Speicherkontingente und ungefähres E-Mail-Volumen pro Postfach

**Schritt B — E-Mail-Lösung bei Hostinger festlegen**

Optionen:
- Hostingers im Hosting enthaltene E-Mail-Konten (begrenzt; prüfen, was im erworbenen Tarif enthalten ist)
- Hostinger Email (kostenpflichtig, separat vom Webhosting — empfohlen für die professionelle Nutzung)
- Google Workspace (extern, robusteste Lösung, erfordert MX-Eintrag auf Google statt auf Hostinger)

**Schritt C — Postfächer bei Hostinger neu anlegen**

Im hPanel → E-Mails → jedes Postfach mit der **gleichen Adresse** wie bei Strato anlegen. Starke neue Passwörter vergeben. Sicher dokumentieren.

**Schritt D — Bestehende E-Mails migrieren (BEVOR Strato abgeschaltet wird)**

Beide Postfächer müssen für die Migration gleichzeitig aktiv sein. Zwei sinnvolle Methoden:

- **IMAP-zu-IMAP-Synchronisation** mit `imapsync` (Kommandozeilen-Tool) oder Hostingers integriertem E-Mail-Migrationstool, falls im Tarif verfügbar. Bewahrt Ordner, Datumsangaben und Lese-/Ungelesen-Status. Am besten für große Postfächer.
- **Thunderbird per Drag-and-Drop**: Thunderbird mit beiden Postfächern (alt und neu) per IMAP verbinden, Ordner herüberziehen. Langsamer, aber visuell und zuverlässig.

**Schritt E — MX-Einträge umstellen**

Nachdem die Postfächer bei Hostinger bestehen und die vorhandenen E-Mails übertragen wurden, die MX-Einträge ändern (im Hostinger-DNS, sobald dieser für die .de-Domains zuständig ist), sodass sie auf Hostingers Mailserver zeigen. Mit einem Zeitfenster von 24–72 Stunden rechnen, in dem einzelne E-Mails noch bei Strato eingehen können — deshalb bleiben beide Postfächer während der Umstellung aktiv.

**Schritt F — E-Mail-Programme aktualisieren**

Birgit und Alexander müssen Outlook / Apple Mail / Smartphone-IMAP- und SMTP-Einstellungen auf Hostingers Server umstellen. An einem ruhigen Tag einplanen. Beide mit den neuen Servernamen, Ports und Passwörtern versorgen.

## Empfohlene Reihenfolge der Schritte

1. **Heute:** Beide Domain-Übertragungen bei Hostinger mit den Auth-Codes anstoßen. Damit beginnt die Frist und Schutz vor Auth-Code-Ablauf ist gegeben.
2. **Heute / morgen:** Strato-Postfächer inventarisieren; entsprechende Postfächer bei Hostinger anlegen.
3. **Innerhalb von 1–3 Tagen** (während des Übertragungsfensters): IMAP-Migration der bestehenden E-Mails von Strato zu Hostinger durchführen.
4. **Sobald die Domain-Übertragung abgeschlossen ist** (1–4 Tage bei .de):
  - WordPress-Primärdomain pro Site von `*.hostingersite.com` auf die echte `.de`-Domain umstellen
  - Suchen-und-Ersetzen in den WP-Datenbanken durchführen
  - MX-Einträge auf Hostinger-Mailserver aktualisieren
  - SSL-Ausstellung verifizieren
5. **Nach der Umstellung:**
  - E-Mail-Programm-Einstellungen von Birgit und Alexander aktualisieren (IMAP/SMTP)
  - Alle Kontaktformulare sowie ein- und ausgehende E-Mails testen
  - **Strato mindestens 7 Tage aktiv lassen** als Sicherheitsnetz für verspätete E-Mails und DNS-Propagationsfälle

## Risikoregister

| Risiko | Maßnahme |
|---|---|
| Auth-Code läuft vor Anstoß der Übertragung ab | Übertragungen sofort starten; bei Bedarf bei Strato neu anfordern |
| Strato-Kündigungsdatum verstreicht vor Anstoß der Übertragung | Genaues "Vertragsende"-Datum heute prüfen; Übertragung muss vorher gestartet sein |
| E-Mails gehen während der Umstellung verloren | IMAP-zu-IMAP migrieren, solange beide Anbieter aktiv sind; Strato 7+ Tage nach Umstellung weiterlaufen lassen |
| WP-Site bricht nach Domainwechsel (fest codierte Staging-URLs) | Gründliches Suchen und Ersetzen in der Datenbank; Admin und Frontend vor der Bekanntmachung testen |
| SSL wird für .de-Domain nicht ausgestellt | Hostinger stellt Let's Encrypt automatisch aus; bei Verzögerung manuell aus dem hPanel anstoßen |
| Patienten erreichen die Praxis während der Umstellung nicht | Umstellung in eine verkehrsarme Phase legen; ggf. Hinweis veröffentlichen, falls Ausfallzeiten zu erwarten sind |

## Referenz: Strato Auth-Code-Anforderung (falls Neuausstellung nötig)

1. Im Strato-Login-Bereich mit Kundennummer oder Domainname anmelden
2. Schaltfläche "Einstellungen" → Vertragsservice → Domainverwaltung → Domain(s)-Übersicht
3. Neben der gekündigten Domain auf **Auth-Code anfordern** / **Authcode anfordern** klicken
4. Der Code wird an die hinterlegte E-Mail-Adresse des Domaininhabers verschickt (Zustellung innerhalb von ca. 24 Stunden)
5. .de-Codes sind ab Ausstellung 30 Tage gültig