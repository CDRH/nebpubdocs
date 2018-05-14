#!/bin/sh

# Script to verify the number of chunked files matches the number of <div3>
# tags from the source issue xml

echo ""
echo "(The number of chunks and divs should match exactly)"
echo ""

SRC=../xml
CHNK_SRC=../xml/tei-chunks
PATTERN="f17\.[0-9]{4}\.xml"

FILES=`ls ${SRC} | grep -E ${PATTERN}`

total_divs=0
total_chunks=0

for file in $FILES;do
    date=`echo "${file}" | cut -d "." -f 2`
    divs=`grep "<div3" ${SRC}/${file} | wc -l`
    chunks=`ls ${CHNK_SRC} | grep $date | wc -l`
    echo "${file}: ${divs} divs, ${chunks} chunks"

    let total_divs=$total_divs+$divs
    let total_chunks=$total_chunks+$chunks
done

echo ""
echo "Total divs: ${total_divs}"
echo "Total chunks: ${total_chunks}"
