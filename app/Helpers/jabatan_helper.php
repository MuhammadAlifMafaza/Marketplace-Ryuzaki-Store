<?php

function isJabatan($jabatanName)
{
    return session()->get('jabatan') === $jabatanName;
}

function isAnyJabatan(...$jabatan)
{
    return in_array(session()->get('jabatan'), $jabatan);
}
