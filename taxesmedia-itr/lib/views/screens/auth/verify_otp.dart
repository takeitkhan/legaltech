import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/controllers/auth.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';
import 'package:otp_text_field/otp_text_field.dart';
import 'package:otp_text_field/style.dart';

class VerfiyOTPScreen extends HookConsumerWidget {
  const VerfiyOTPScreen({Key? key, required this.number}) : super(key: key);

  final String number;

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    late Timer timer;
    final clock = useState(60);
    final resendAvailable = useState(false);
    final resendDone = useState(false);

    useEffect(() {
      timer = Timer.periodic(
        const Duration(seconds: 1),
        (timer) {
          if (clock.value == 1) {
            timer.cancel();
            resendAvailable.value = true;
            return;
          }
          clock.value--;
        },
      );
      return () {
        timer.cancel();
      };
    }, []);

    return GradientScaffold(
      appBar: const TransparentAppBar(),
      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: ListView(
            children: [
              Text(
                AppLocalizations.of(context)!.enter_otp,
                style: Theme.of(context).textTheme.headline3,
              ),
              const SizedBox(height: 12),
              Text(
                AppLocalizations.of(context)!.we_sent_it_to(number),
                style: Theme.of(context).textTheme.subtitle2,
              ),
              const SizedBox(height: 40),
              OTPTextField(
                fieldWidth: 55,
                fieldStyle: FieldStyle.box,
                contentPadding: const EdgeInsets.all(18),
                otpFieldStyle: OtpFieldStyle(
                  backgroundColor:
                      Theme.of(context).inputDecorationTheme.fillColor ??
                          Colors.white,
                  borderColor: Theme.of(context)
                          .inputDecorationTheme
                          .enabledBorder
                          ?.borderSide
                          .color ??
                      Colors.white,
                ),
                onCompleted: (otp) {
                  ref.read(authControllerProvider).verifyOTP(number, otp).then(
                    (result) {
                      if (result == AuthStatus.registered) {
                        return Navigator.pushNamedAndRemoveUntil(
                          context,
                          Routes.home,
                          (route) => false,
                        );
                      } else if (result == AuthStatus.verified) {
                        return Navigator.pushNamedAndRemoveUntil(
                          context,
                          Routes.tinNid,
                          arguments: number,
                          (route) => false,
                        );
                      } else {
                        ScaffoldMessenger.of(context).showSnackBar(
                          SnackBar(
                            content:
                                Text(AppLocalizations.of(context)!.invalid_otp),
                          ),
                        );
                      }
                    },
                  );
                },
              ),
              const SizedBox(height: 30),
              if (resendAvailable.value)
                Visibility(
                  visible: !resendDone.value,
                  child: TextButton(
                    onPressed: () {
                      ref.read(authControllerProvider).sendOTP(number);
                      ScaffoldMessenger.of(context).showSnackBar(
                        const SnackBar(
                          content: Text('OTP successfully sent'),
                        ),
                      );
                      resendDone.value = true;
                    },
                    child: const Text('Resend OTP'),
                  ),
                )
              else
                Text(
                  '${AppLocalizations.of(context)!.resend_code_in} 00:${clock.value}',
                  textAlign: TextAlign.center,
                ),
            ],
          ),
        ),
      ),
    );
  }
}
