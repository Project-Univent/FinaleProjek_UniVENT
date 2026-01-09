<?php
class ApiClientCalendar {
  private $service;
  private $cacheFile;
  private $ttl = 600;

  public function __construct($googleService) {
    $this->service = $googleService;
    $this->cacheFile = __DIR__ . '/../admin/data/calendar.json';
  }

  public function fetchEvents() {
    // cache
    if (file_exists($this->cacheFile)) {
      $age = time() - filemtime($this->cacheFile);
      if ($age < $this->ttl) {
        return json_decode(file_get_contents($this->cacheFile), true);
      }
    }

    // fetch api
    $events = $this->service->events->listEvents(
      'primary',
      [
        'singleEvents' => true,
        'orderBy' => 'startTime'
      ]
    );

    $data = [];
    foreach ($events->getItems() as $event) {
      $data[] = [
        'summary' => $event->getSummary(),
        'start'   => $event->getStart()->getDateTime()
      ];
    }

    // simpan cache
    file_put_contents($this->cacheFile, json_encode($data));

    return $data;
  }
}
