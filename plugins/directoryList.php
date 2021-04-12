<?php
class directoryList
{
    const version = '1.0';
    private function getFiles($dir)
    {
        $folder = $dir . "/*.md";
        foreach (glob($folder) as $filePath) {
            $fileName = substr($filePath, strpos($filePath, "/") + 1, -3);
            $md = file_get_contents($filePath);
            preg_match('/# (.*?)\n/', $md, $h1)[1];
            $option .= "\t<option ";
            if ($fileName == $GLOBALS["page"]) {
                $option .= "selected ";
            }
            $option .= "value=\"?page=" . $fileName . "\">" . $h1[1] . "</option>";
        }
        return $option;
    }
    public function addInfo()
    {
        $txt .= "<select onchange=\"location = this.options[this.selectedIndex].value;\">";
        $txt .= $this->getFiles("pages");
        foreach (glob("pages/*", GLOB_ONLYDIR) as $dir) {
            $txt .= "<optgroup label=\"" . basename($dir) . "\">";
            $txt .= $this->getFiles($dir);
            $txt .= "</optgroup>";
        }
        $txt .= "</select>";
        print($txt);
    }
}
