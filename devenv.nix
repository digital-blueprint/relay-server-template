{
  # https://devenv.sh/supported-languages/php/
  languages.php = {
    enable = true;
    version = "8.3";
  };

  dotenv.disableHint = true;

  enterShell = ''
    echo "🔨 DBP Relay API Server Template dev shell"
    echo "🐘 PHP version: $(php --version | head -n 1)"
  '';

  # https://devenv.sh/git-hooks/
  git-hooks = {
    excludes = [
      "config/secrets"
      "vendor"
      "bin"
    ];
    hooks = {
      php-cs-fixer = {
        enable = true;
        args = [
          "--config"
          "./.php-cs-fixer.dist.php"
        ];
        excludes = [ "config/bundles.php" ];
        # Don't spam so many messages
        require_serial = true;
      };

      prettier.args = [
        "--tab-width"
        "4"
      ];
    };
  };

  # See full reference at https://devenv.sh/reference/options/
}
