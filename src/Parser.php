<?php


namespace JK\DslAnalytics;


use League\Csv\Reader;

class Parser
{
    /**
     * @param string $filepath
     * @return array
     */
    public function convertToArray($filepath)
    {
        $reader = Reader::createFromPath($filepath);
        $reader->setDelimiter(',');

        $date = $reader->setOffset(5)->fetchColumn(0);
        $mbps = $reader->setOffset(5)->fetchColumn(5);

        $date = array_slice($date, 0, count($mbps));

        $data_unprocessed = array_combine($date, $mbps);
        $data = [];
        foreach ($data_unprocessed as $thisDate => $thisMbps) {
            $datetime = new \DateTime($thisDate);
            $index1 = Helper::hashToFirstIndex($datetime);
            $index2 = Helper::hashToSecondIndex($datetime);

            $time = Helper::indexToTime($index2);


//            $data[$index1][$index2] = ['mbps' => floatval($thisMbps), 'time' => $time_str];
            $data[$index1][$index2] = floatval($thisMbps);
        }

        return $data;
    }
}
