{ pkgs, lib, config, inputs, ... }:

{
  # https://devenv.sh/supported-languages/php/
  languages.php = {
    enable = true;
    version = "8.3";
  };

  enterShell = ''
    echo "🔨 DBP Relay API Server Template dev shell"
  '';

  # See full reference at https://devenv.sh/reference/options/
}
