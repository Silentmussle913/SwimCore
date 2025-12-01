# Developer Docs & Automation

This repository includes the `docs/` folder with module-level and coverage documentation. To extend or maintain docs:

1. Add a module doc page under `docs/api/modules/` with a list of classes in that folder.
2. For detailed class documentation, add `docs/api/classes/<ClassName>.md` and link it from the module page.
3. Update `docs/api/TOC.md` and `docs/api/FILES.md` if you add/remove files.

Automating docs
- You can write a small PHP or Node.js script to parse PHP files for class declarations and docblocks and auto-generate documentation pages. Example approach:
  - Use `token_get_all()` in PHP or a simple regex parse to find `class`, `abstract class`, and `interface` keywords. Then extract the docblock comment above it if present.
  - Output a markdown file for each class under `docs/api/classes/` including method and property stubs (or simply link to source file).

Suggested script location: `tools/docs_generator.php`.

If you'd like, I can prototype `tools/docs_generator.php` or a small script to generate per-class docs automatically from the repo.

Auto-generated aggregate docs
- The repo includes a Python script that walks `src/core` and generates a single `docs/Documentation.md` with every class, method, docblock, parameters, return types, and a sample PHP usage example.
- To re-generate documentation using the repo virtualenv Python, run (without activating the venv):

```powershell
& "E:/projects backup/github/SwimCore/.venv/Scripts/python.exe" "e:/projects backup/github/SwimCore/scripts/generate_documentation.py"
```

If you prefer to activate the venv in PowerShell, you may need to temporarily allow script execution for the session:

```powershell
Set-ExecutionPolicy -Scope Process -ExecutionPolicy RemoteSigned
& ".venv/Scripts/Activate.ps1"
```

Note: Running `Activate.ps1` may require admin or policy changes. If you don't want to change execution policy, run the venv Python directly as shown above.