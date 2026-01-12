<?php

function resolve_git_dir(string $repoRoot): ?string {
    $gitPath = $repoRoot . '/.git';
    if (is_dir($gitPath)) {
        return $gitPath;
    }

    if (is_file($gitPath)) {
        $content = file_get_contents($gitPath);
        if ($content === false) {
            return null;
        }
        if (preg_match('/^gitdir:\s*(.+)\s*$/m', $content, $matches)) {
            $gitDir = $matches[1];
            if ($gitDir[0] !== '/') {
                $gitDir = $repoRoot . '/' . $gitDir;
            }
            return is_dir($gitDir) ? $gitDir : null;
        }
    }

    return null;
}

function get_git_info(string $repoRoot): array {
    $gitDir = resolve_git_dir($repoRoot);
    if (!$gitDir) {
        return [
            'branchName' => false,
            'lastCommitDate' => false,
        ];
    }

    $headFile = file_get_contents($gitDir . '/HEAD');
    if ($headFile === false) {
        return [
            'branchName' => false,
            'lastCommitDate' => false,
        ];
    }

    $branchName = false;
    if (preg_match('/ref:\s*refs\/heads\/(.+)/', $headFile, $matches)) {
        $branchName = trim($matches[1]);
    }

    $lastCommitDate = false;
    if ($branchName) {
        $refPath = $gitDir . '/refs/heads/' . $branchName;
        $commitHash = false;

        if (file_exists($refPath)) {
            $commitHash = trim((string) file_get_contents($refPath));
        }

        if ($commitHash) {
            $commitFilePath = $gitDir . '/objects/' . substr($commitHash, 0, 2) . '/' . substr($commitHash, 2);
            if (file_exists($commitFilePath)) {
                $commitData = file_get_contents($commitFilePath);
                if ($commitData !== false) {
                    $uncompressedData = zlib_decode($commitData);
                    if ($uncompressedData !== false &&
                        preg_match('/^committer [^\n]+<[^>]+> (\d+) [+-]\d{4}/m', $uncompressedData, $dateMatches)
                    ) {
                        $timestamp = (int) $dateMatches[1];
                        $lastCommitDate = date('Y-m-d H:i:s', $timestamp);
                    }
                }
            }
        }
    }

    return [
        'branchName' => $branchName,
        'lastCommitDate' => $lastCommitDate,
    ];
}

