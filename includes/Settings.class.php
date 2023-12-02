<?php

namespace Doctor;

if (!defined("ABSPATH")) {
    exit;
}

class Settings
{
    public function checkRequirements()
    {
        $result = $this->checkPhp() && $this->checkPlugins();

        if (!$result) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }

        return $result;
    }

    private function checkPhp($printNotice = false)
    {
        $requiredMinimumPhpVersion = DOCTOR_PHP_REQUIREMENT;
        $phpIsValid = version_compare(PHP_VERSION, $requiredMinimumPhpVersion, ">=");
        if (!$phpIsValid && $printNotice) {
            add_action( 'admin_notices', [$this, "noticePhp"] );
        }

        return $phpIsValid;
    }

    public function noticePhp() {
        // @TODO : Print alert message to explain php need to be higher version
        echo "noticePhp";
    }

    private function checkPlugins($printNotice = false)
    {
        $pluginsLists = [
            [
                "Polylang" => function_exists("pll_the_languages"),
                "WPML" => function_exists("wpml_current_language"),
                "MultilingualPress" => function_exists("mlp_get_interlinked_permalinks"),
            ]
        ];

        $result = true;
        $pluginsListsMissing = [];
        foreach ($pluginsLists as $plugins) {
            $resultList = false;
            $listsMissing = [];
            foreach ($plugins as $pluginName => $pluginIsAvailable) {
                if (!$pluginIsAvailable) {
                    $listsMissing[] = $pluginName;
                }
                $resultList = $resultList || $pluginIsAvailable;
            }
            $result = $result && $resultList;
            if (!$resultList) {
                $pluginsListsMissing[] = $listsMissing;
            }
        }

        if (!$result && $printNotice) {
            foreach ($pluginsListsMissing as $listMissing) {
                $notice = "Doctor required at least one of the following plugins " . join(", ", $listMissing);
                add_action( 'admin_notices', function () use ($notice) {
                    echo $notice;
                });
            }
        }

        return $result;
    }

    public function generateAndSaveToken(): string {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $token = '';

        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $token .= $characters[rand(0, strlen($characters) - 1)];
            }
            if ($i < 3) {
                $token .= '-';
            }
        }

        add_option("seo_sans_migraine_token", $token);
        return $token;
    }

    public function getToken(): string {
        $token = get_option("seo_sans_migraine_token");
        if (empty($token)) {
            $token = $this->generateAndSaveToken();
        }

        return $token;
    }
}