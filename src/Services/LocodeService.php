<?php
namespace App\Services;

use App\Entity\Locode;
use App\Normalizer\LocodeNormalizer;
use App\Repository\LocodeRepository;
use Doctrine\ORM\EntityManagerInterface;

class LocodeService {
    /**
     * @var LocodeRepository
     */
    private $locodeRepository;
    /**
     * @var ocodeNormalizer
     */
    private $locodeNormalizer;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var CsvParser
     */
    private $csvParser;

    private $counter;

    /**
     * Locode constructor.
     */
    public function __construct(
        EntityManagerInterface $em,
        LocodeRepository $locodeRepository,
        LocodeNormalizer $locodeNormalizer,
        CsvParser $csvParser
    ) {
        $this->locodeRepository = $locodeRepository;
        $this->locodeNormalizer = $locodeNormalizer;
        $this->em = $em;
        $this->csvParser = $csvParser;
    }

    public function getLocationsByCode($code) {
        return $this->locodeNormalizer->normalizeList($this->locodeRepository->findByCode($code));
    }

    public function getLocationsByNameWoDiacritics($code) {
        return $this->locodeNormalizer->normalizeList($this->locodeRepository->findByNameWoDiacritics($code));
    }

    /**
     * Parse LOCODE comma-separated files and import data to database
     *
     * @param $filename
     * @return int number of records imported
     * @throws \Exception
     */
    public function parseCsv($filename) {
        $this->counter = 0;
        $callback = [$this, "addRowCallback"];
        $this->csvParser->parse($filename, $callback);
        return $this->counter;
    }

    public function addRowCallback(array $row) {
        $this->counter++;
        $locode = new Locode(
            $row[1],
            $row[2],
            $row[3],
            $row[4],
            $row[5],
            $this->parseFunctionType($row[6]),
            $row[7],
            new \DateTime($row[8]),
            $row[9],
            $row[10],
            $row[11]
        );

        $this->em->persist($locode);
        $this->em->flush();
    }

    protected function parseFunctionType($value) {
        //todo: move method to Entity
        if (strlen($value) != 8) return ["unknown"]; //or Exception

        // to DRY: see FunctionType; define set of constants
        $possibleValues = ["unknown", "port", "rail", "road", "airport", "postal", "multimodal", "fixedtransport", "border"];

        if ($value[0] == "0") return ["unknown"];

        $result = [];
        for ($i = 0; $i < strlen($value); $i++) {
            if ($value[$i] != '-') {
                $result[] = $possibleValues[$i];
            }
        }

        return $result ?? ["unknown"];
    }

    public function clearDb() {
        $this->locodeRepository->clearDb();
    }
}