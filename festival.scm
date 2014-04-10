    ;; Enable access to localhost (needed by debian users)
    (set! server_access_list '("localhost\\.localdomain" "localhost"))

    ;;; Command for Asterisk begin

    (define (tts_textasterisk string mode)
    "(tts_textasterisk STRING MODE)
    Apply tts to STRING. This function is specifically designed for
    use in server mode so a single function call may synthesize the string.
    This function name may be added to the server safe functions."
    (let ((wholeutt (utt.synth (eval (list 'Utterance 'Text string)))))
    (utt.wave.resample wholeutt 8000)
    (utt.wave.rescale wholeutt 5)
    (utt.send.wave.client wholeutt)))




    ;;; Command for Asterisk end

(Parameter.set 'Audio_Command "aplay -D plug:dmix -q -c 1 -t raw -f s16 -r $SR $FILE")
(Parameter.set 'Audio_Method 'Audio_Command)
(Parameter.set 'Audio_Required_Format 'snd)
;; set russian voice (comment the following 2 lines to use british_american)
(proclaim_voice 
 'msu_ru_nsh_clunits 
 '((language russian) 
   (gender male) 
   (dialect moscow) 
   (coding utf-8) 
   (description 
    "Russian festival voice."))) 
(language_russian)
(set! voice_default 'voice_msu_ru_nsh_clunits)
