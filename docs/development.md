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