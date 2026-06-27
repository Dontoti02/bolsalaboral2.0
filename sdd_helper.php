<?php
// Helper script for superpowers SDD workflows on Windows

$action = $argv[1] ?? '';

switch ($action) {
    case 'task-brief':
        if (count($argv) < 4) {
            echo "Usage: php sdd_helper.php task-brief PLAN_FILE TASK_NUMBER\n";
            exit(1);
        }
        $planFile = $argv[2];
        $taskNum = $argv[3];
        
        if (!file_exists($planFile)) {
            echo "Error: Plan file not found: $planFile\n";
            exit(1);
        }
        
        $lines = file($planFile);
        $inFence = false;
        $inTask = false;
        $extractedLines = [];
        
        foreach ($lines as $line) {
            if (strpos($line, '```') === 0) {
                $inFence = !$inFence;
            }
            
            if (!$inFence && preg_match('/^#+\s+Task\s+(\d+)/i', $line, $matches)) {
                $currentTaskNum = $matches[1];
                $inTask = ($currentTaskNum === $taskNum);
            }
            
            if ($inTask) {
                $extractedLines[] = $line;
            }
        }
        
        if (empty($extractedLines)) {
            echo "Error: Task $taskNum not found in $planFile\n";
            exit(1);
        }
        
        $sddDir = __DIR__ . '/.superpowers/sdd';
        if (!file_exists($sddDir)) {
            mkdir($sddDir, 0755, true);
        }
        
        $outFile = "$sddDir/task-{$taskNum}-brief.md";
        file_put_contents($outFile, implode("", $extractedLines));
        echo "Wrote task brief: $outFile\n";
        break;

    case 'review-package':
        if (count($argv) < 4) {
            echo "Usage: php sdd_helper.php review-package BASE HEAD\n";
            exit(1);
        }
        $base = $argv[2];
        $head = $argv[3];
        
        $sddDir = __DIR__ . '/.superpowers/sdd';
        if (!file_exists($sddDir)) {
            mkdir($sddDir, 0755, true);
        }
        
        // Resolve BASE and HEAD short hashes
        $baseShort = trim(shell_exec("git rev-parse --short " . escapeshellarg($base)));
        $headShort = trim(shell_exec("git rev-parse --short " . escapeshellarg($head)));
        
        $outFile = "$sddDir/review-{$baseShort}..{$headShort}.diff";
        
        $output = "# Review package: {$base}..{$head}\n\n";
        $output .= "## Commits\n";
        $output .= shell_exec("git log --oneline " . escapeshellarg("{$base}..{$head}"));
        $output .= "\n## Files changed\n";
        $output .= shell_exec("git diff --stat " . escapeshellarg("{$base}..{$head}"));
        $output .= "\n## Diff\n";
        $output .= shell_exec("git diff -U10 " . escapeshellarg("{$base}..{$head}"));
        
        file_put_contents($outFile, $output);
        echo "Wrote review package: $outFile\n";
        break;

    default:
        echo "Unknown action. Use 'task-brief' or 'review-package'\n";
        exit(1);
}
